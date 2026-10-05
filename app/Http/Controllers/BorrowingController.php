<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Daftar buku yang tersedia untuk dipinjam
     */
    public function daftarBuku(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $books = $query->latest()->paginate(12);
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('user.books.index', compact('books', 'kategoris'));
    }

    /**
     * Detail buku + form ajukan pinjam
     */
    public function detailBuku(Book $book)
    {
        // Cek apakah user sudah meminjam buku ini dan belum dikembalikan
        $sedangMeminjam = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', '!=', 'dikembalikan')
            ->exists();

        return view('user.books.show', compact('book', 'sedangMeminjam'));
    }

    /**
     * Ajukan peminjaman buku
     */
    public function ajukanPinjam(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tenggat_waktu' => ['required', 'date', 'after:today', 'before_or_equal:'.now()->addDays(30)->toDateString()],
        ]);

        $book = Book::findOrFail($request->book_id);

        // Cek stok
        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku sudah habis.');
        }

        // Cek apakah user sudah meminjam buku ini
        $sudahMeminjam = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', '!=', 'dikembalikan')
            ->exists();

        if ($sudahMeminjam) {
            return back()->with('error', 'Kamu sudah meminjam buku ini dan belum mengembalikannya.');
        }

        // Batas max peminjaman aktif (misalnya 3 buku sekaligus)
        $jumlahAktif = Borrowing::where('user_id', auth()->id())
            ->where('status', '!=', 'dikembalikan')
            ->count();

        if ($jumlahAktif >= 3) {
            return back()->with('error', 'Kamu sudah meminjam 3 buku sekaligus. Kembalikan dulu sebelum meminjam lagi.');
        }

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'tenggat_waktu' => $request->tenggat_waktu,
            'tanggal_pengajuan_pinjam' => now(),
            'status' => 'menunggu_konfirmasi_pinjam',
            'denda' => 0,
        ]);

        return redirect()->route('user.riwayat')
            ->with('success', "Pengajuan pinjam buku \"{$book->judul}\" telah dikirim dan menunggu konfirmasi admin.");
    }

    /**
     * Riwayat peminjaman user
     */
    public function riwayat()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.borrowings.riwayat', compact('borrowings'));
    }

    /**
     * Ajukan pengembalian buku
     * User mengklik "Kembalikan", status menjadi menunggu konfirmasi admin
     * (dalam implementasi sederhana: langsung set status dikembalikan & admin konfirmasi)
     */
    public function ajukanKembali(Request $request, Borrowing $borrowing)
    {
        // Pastikan ini milik user yang login
        if ($borrowing->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan.');
        }

        if (! in_array($borrowing->status, ['dipinjam', 'terlambat'], true)) {
            return back()->with('error', 'Pengembalian buku tidak dapat diajukan untuk status saat ini.');
        }

        // Set status ke "menunggu konfirmasi" — tapi karena flow kita:
        // user klik kembalikan → admin yang approve (ubah jadi dikembalikan)
        // Kita pakai kolom status = 'dikembalikan' dengan tanggal_kembali = hari ini
        // lalu admin yang memvalidasi denda
        //
        // Untuk alur ini kita simpan tanggal_kembali dulu, status tetap 'dipinjam'
        // sampai admin mengkonfirmasi. Tapi karena tidak ada status "pending_return",
        // kita set langsung dan admin bisa mengubah denda.

        $borrowing->update([
            'tanggal_pengajuan_kembali' => now(),
            'status' => 'menunggu_konfirmasi_kembali',
        ]);

        return redirect()->route('user.riwayat')
            ->with('success', 'Pengajuan pengembalian telah dicatat. Tanggal pengajuan ini akan dipakai saat admin menghitung denda, sehingga keterlambatan konfirmasi admin tidak menambah denda.');
    }
}
