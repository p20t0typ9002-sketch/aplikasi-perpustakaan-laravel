<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Tampilkan semua daftar peminjaman
     */
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian nama user atau judul buku
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('book', fn ($b) => $b->where('judul', 'like', "%{$search}%"));
            });
        }

        $borrowings = $query->latest()->paginate(15);

        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Form tambah peminjaman (admin yang input manual)
     */
    public function create()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        $books = Book::where('stok', '>', 0)->orderBy('judul')->get();

        return view('admin.borrowings.create', compact('users', 'books'));
    }

    /**
     * Simpan peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tenggat_waktu' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok <= 0) {
            return back()->withErrors(['book_id' => 'Stok buku tidak tersedia.'])->withInput();
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_waktu' => $request->tenggat_waktu,
            'status' => 'dipinjam',
            'denda' => 0,
        ]);

        // Kurangi stok buku
        $book->decrement('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Detail satu peminjaman
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['user', 'book']);

        return view('admin.borrowings.show', compact('borrowing'));
    }

    /**
     * Konfirmasi pengajuan peminjaman dari pengguna.
     */
    public function konfirmasiPinjam(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'menunggu_konfirmasi_pinjam') {
            return back()->with('error', 'Pengajuan peminjaman ini sudah diproses.');
        }

        $book = $borrowing->book;

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia untuk mengonfirmasi pengajuan ini.');
        }

        $durasiPeminjaman = max(1, $borrowing->tanggal_pengajuan_pinjam->startOfDay()->diffInDays($borrowing->tenggat_waktu, false));
        $tanggalPinjam = now();

        $borrowing->update([
            'tanggal_pinjam' => $tanggalPinjam->toDateString(),
            'tanggal_konfirmasi_pinjam' => $tanggalPinjam,
            'tenggat_waktu' => $tanggalPinjam->copy()->addDays($durasiPeminjaman)->toDateString(),
            'status' => 'dipinjam',
        ]);

        $book->decrement('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    /**
     * Proses pengembalian buku: ubah status, hitung denda, tambah stok
     */
    public function kembalikan(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'menunggu_konfirmasi_kembali') {
            return back()->with('error', 'Pengembalian harus diajukan oleh pengguna sebelum dapat dikonfirmasi.');
        }

        $tanggalKembali = $borrowing->tanggal_pengajuan_kembali;

        // Hitung denda (Rp 1.000/hari keterlambatan)
        $denda = 0;
        $terlambat = $borrowing->tenggat_waktu->diffInDays($tanggalKembali->copy()->startOfDay(), false);
        if ($terlambat > 0) {
            $denda = $terlambat * 1000;
        }

        $borrowing->update([
            'tanggal_kembali' => $tanggalKembali->toDateString(),
            'tanggal_konfirmasi_kembali' => now(),
            'status' => 'dikembalikan',
            'denda' => $denda,
        ]);

        // Tambah kembali stok buku
        $borrowing->book->increment('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan'.($denda > 0 ? ' dengan denda Rp '.number_format($denda, 0, ',', '.') : '').'.');
    }

    /**
     * Tandai status peminjaman sebagai terlambat secara manual
     * (biasanya dipanggil lewat scheduled command, tapi bisa manual juga)
     */
    public function tandaiTerlambat()
    {
        $jumlah = Borrowing::whereIn('status', ['dipinjam', 'terlambat'])
            ->where('tenggat_waktu', '<', now()->toDateString())
            ->update(['status' => 'terlambat']);

        return back()->with('success', "{$jumlah} peminjaman ditandai terlambat.");
    }

    /**
     * Laporan peminjaman
     */
    public function laporan(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data = Borrowing::with(['user', 'book'])
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulan)
            ->get();

        $totalPeminjaman = $data->count();
        $totalDikembalikan = $data->where('status', 'dikembalikan')->count();
        $totalTerlambat = $data->whereIn('status', ['terlambat', 'dikembalikan'])
            ->where('denda', '>', 0)->count();
        $totalDenda = $data->sum('denda');

        // Data per bulan untuk chart (12 bulan terakhir)
        $perBulan = [];
        for ($i = 11; $i >= 0; $i--) {
            $tanggal = now()->subMonths($i);
            $perBulan[] = [
                'label' => $tanggal->translatedFormat('M Y'),
                'jumlah' => Borrowing::whereYear('tanggal_pinjam', $tanggal->year)
                    ->whereMonth('tanggal_pinjam', $tanggal->month)
                    ->count(),
            ];
        }

        return view('admin.borrowings.laporan', compact(
            'data', 'totalPeminjaman', 'totalDikembalikan',
            'totalTerlambat', 'totalDenda', 'perBulan', 'bulan', 'tahun'
        ));
    }

    /**
     * Export laporan peminjaman sebagai PDF
     */
    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data = Borrowing::with(['user', 'book'])
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulan)
            ->get();

        $totalPeminjaman = $data->count();
        $totalDikembalikan = $data->where('status', 'dikembalikan')->count();
        $totalTerlambat = $data->whereIn('status', ['terlambat', 'dikembalikan'])
            ->where('denda', '>', 0)->count();
        $totalDenda = $data->sum('denda');

        $namaBulan = \Carbon\Carbon::create(null, $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('admin.borrowings.laporan-pdf', compact(
            'data', 'totalPeminjaman', 'totalDikembalikan',
            'totalTerlambat', 'totalDenda', 'bulan', 'tahun', 'namaBulan'
        ));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download("laporan-peminjaman-{$namaBulan}-{$tahun}.pdf");
    }

    /**
     * Hapus data peminjaman
     */
    public function destroy(Borrowing $borrowing)
    {
        // Jika masih aktif, kembalikan stok dulu
        if (in_array($borrowing->status, ['dipinjam', 'terlambat', 'menunggu_konfirmasi_kembali'], true)) {
            $borrowing->book->increment('stok');
        }

        $borrowing->delete();

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
