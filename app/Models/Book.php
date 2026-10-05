<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'kategori',
        'tahun_terbit',
        'stok',
        'cover',
    ];

    /**
     * Relasi: satu buku bisa punya banyak peminjaman
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Cek apakah stok masih tersedia
     */
    public function isAvailable(): bool
    {
        return $this->stok > 0;
    }
}
