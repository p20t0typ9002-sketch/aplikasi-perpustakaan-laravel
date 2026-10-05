<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status', [
                'menunggu_konfirmasi_pinjam',
                'dipinjam',
                'menunggu_konfirmasi_kembali',
                'dikembalikan',
                'terlambat',
            ])->default('menunggu_konfirmasi_pinjam')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])
                ->default('dipinjam')
                ->change();
        });
    }
};
