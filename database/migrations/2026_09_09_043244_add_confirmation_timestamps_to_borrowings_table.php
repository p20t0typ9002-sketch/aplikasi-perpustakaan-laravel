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
            $table->date('tanggal_pinjam')->nullable()->change();
            $table->timestamp('tanggal_pengajuan_pinjam')->nullable()->after('book_id');
            $table->timestamp('tanggal_konfirmasi_pinjam')->nullable()->after('tanggal_pinjam');
            $table->timestamp('tanggal_pengajuan_kembali')->nullable()->after('tanggal_kembali');
            $table->timestamp('tanggal_konfirmasi_kembali')->nullable()->after('tanggal_pengajuan_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_pengajuan_pinjam',
                'tanggal_konfirmasi_pinjam',
                'tanggal_pengajuan_kembali',
                'tanggal_konfirmasi_kembali',
            ]);
            $table->date('tanggal_pinjam')->nullable(false)->change();
        });
    }
};
