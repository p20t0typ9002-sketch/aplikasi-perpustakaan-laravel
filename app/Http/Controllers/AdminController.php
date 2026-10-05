<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalBuku = Book::count();
        $totalPengguna = User::where('role', 'user')->count();
        $totalDipinjam = Borrowing::where('status', 'dipinjam')->count();
        $totalTerlambat = Borrowing::whereIn('status', ['terlambat'])
            ->orWhere(function ($q) {
                $q->where('status', 'dipinjam')
                    ->where('tenggat_waktu', '<', now()->toDateString());
            })->count();
        $totalDenda = Borrowing::sum('denda');

        // Peminjaman terbaru
        $peminjamanterbaru = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBuku', 'totalPengguna', 'totalDipinjam',
            'totalTerlambat', 'totalDenda', 'peminjamanterbaru'
        ));
    }
}
