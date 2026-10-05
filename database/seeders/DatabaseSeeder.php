<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::firstOrCreate(
            ['email' => 'admin@perpus.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Buat akun user demo (opsional)
        User::firstOrCreate(
            ['email' => 'user@perpus.com'],
            [
                'name' => 'Pengguna Demo',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // Buat beberapa buku contoh
        $books = [
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'penerbit' => 'Hasta Mitra', 'kategori' => 'Fiksi', 'tahun_terbit' => 1980, 'stok' => 5],
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'kategori' => 'Fiksi', 'tahun_terbit' => 2005, 'stok' => 8],
            ['judul' => 'Sapiens', 'penulis' => 'Yuval Noah Harari', 'penerbit' => 'KPG', 'kategori' => 'Non-Fiksi', 'tahun_terbit' => 2011, 'stok' => 3],
            ['judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'penerbit' => 'Gramedia', 'kategori' => 'Pengembangan Diri', 'tahun_terbit' => 2018, 'stok' => 6],
            ['judul' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'penerbit' => 'Prentice Hall', 'kategori' => 'Teknologi', 'tahun_terbit' => 2008, 'stok' => 4],
            ['judul' => 'Harry Potter dan Batu Bertuah', 'penulis' => 'J.K. Rowling', 'penerbit' => 'Gramedia', 'kategori' => 'Fiksi', 'tahun_terbit' => 1997, 'stok' => 7],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                ['judul' => $book['judul']],
                $book
            );
        }
    }
}
