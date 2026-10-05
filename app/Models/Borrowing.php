<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_pengajuan_pinjam',
        'tanggal_konfirmasi_pinjam',
        'tenggat_waktu',
        'tanggal_kembali',
        'tanggal_pengajuan_kembali',
        'tanggal_konfirmasi_kembali',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_pengajuan_pinjam' => 'datetime',
        'tanggal_konfirmasi_pinjam' => 'datetime',
        'tenggat_waktu' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_pengajuan_kembali' => 'datetime',
        'tanggal_konfirmasi_kembali' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Book
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Hitung denda berdasarkan keterlambatan (Rp 1.000/hari)
     */
    public function hitungDenda(): int
    {
        if (! $this->tanggal_kembali || ! $this->tenggat_waktu) {
            return 0;
        }

        $terlambat = $this->tenggat_waktu->diffInDays($this->tanggal_kembali->copy()->startOfDay(), false);

        if ($terlambat <= 0) {
            return 0;
        }

        return $terlambat * 1000; // Rp 1.000 per hari
    }

    /**
     * Scope: peminjaman yang sedang aktif (belum dikembalikan)
     */
    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['dipinjam', 'terlambat', 'menunggu_konfirmasi_kembali']);
    }

    /**
     * Scope: peminjaman yang terlambat
     */
    public function scopeTerlambat($query)
    {
        return $query->where('status', 'terlambat')
            ->orWhere(function ($q) {
                $q->where('status', 'dipinjam')
                    ->where('tenggat_waktu', '<', now()->toDateString());
            });
    }
}
