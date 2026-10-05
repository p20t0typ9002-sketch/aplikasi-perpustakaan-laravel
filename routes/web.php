<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DocumentasiController;
use App\Http\Controllers\ProfileController;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// ─── DOKUMENTASI PDF ──────────────────────────────────────────────────────────
Route::get('/dokumentasi', [DocumentasiController::class, 'preview'])->name('dokumentasi.preview');
Route::get('/dokumentasi/download', [DocumentasiController::class, 'download'])->name('dokumentasi.download');

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── ADMIN ROUTES ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Buku
    Route::resource('books', AdminBookController::class);

    // Peminjaman
    Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/borrowings/create', [AdminBorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [AdminBorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings/{borrowing}', [AdminBorrowingController::class, 'show'])->name('borrowings.show');
    Route::post('/borrowings/{borrowing}/konfirmasi-pinjam', [AdminBorrowingController::class, 'konfirmasiPinjam'])->name('borrowings.konfirmasi-pinjam');
    Route::post('/borrowings/{borrowing}/kembalikan', [AdminBorrowingController::class, 'kembalikan'])->name('borrowings.kembalikan');
    Route::post('/borrowings/tandai-terlambat', [AdminBorrowingController::class, 'tandaiTerlambat'])->name('borrowings.tandai-terlambat');
    Route::delete('/borrowings/{borrowing}', [AdminBorrowingController::class, 'destroy'])->name('borrowings.destroy');

    // Laporan
    Route::get('/laporan', [AdminBorrowingController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/export-pdf', [AdminBorrowingController::class, 'exportPdf'])->name('laporan.export-pdf');
});

// ─── USER ROUTES ─────────────────────────────────────────────────────────────
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Dashboard pengguna
    Route::get('/dashboard', function () {
        $activeBorrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->get();

        return view('user.dashboard', compact('activeBorrowings'));
    })->name('dashboard');

    // Daftar & Detail buku
    Route::get('/books', [BorrowingController::class, 'daftarBuku'])->name('books');
    Route::get('/books/{book}', [BorrowingController::class, 'detailBuku'])->name('books.show');

    // Pinjam buku
    Route::post('/pinjam', [BorrowingController::class, 'ajukanPinjam'])->name('pinjam');

    // Riwayat peminjaman
    Route::get('/riwayat', [BorrowingController::class, 'riwayat'])->name('riwayat');

    // Kembalikan buku
    Route::post('/kembalikan/{borrowing}', [BorrowingController::class, 'ajukanKembali'])->name('kembalikan');
});

// ─── PROFILE ROUTES ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
