<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BorrowingConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_borrowing_request_waits_for_admin_confirmation(): void
    {
        Carbon::setTestNow('2026-09-10 10:00:00');
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);
        $book = Book::create([
            'judul' => 'Buku Uji',
            'penulis' => 'Penulis Uji',
            'penerbit' => 'Penerbit Uji',
            'stok' => 1,
        ]);

        $this->actingAs($user)->post(route('user.pinjam'), [
            'book_id' => $book->id,
            'tenggat_waktu' => '2026-09-17',
        ])->assertRedirect(route('user.riwayat'));

        $borrowing = Borrowing::firstOrFail();

        $this->assertSame('menunggu_konfirmasi_pinjam', $borrowing->status);
        $this->assertNull($borrowing->tanggal_pinjam);
        $this->assertSame(1, $book->fresh()->stok);

        $this->actingAs($admin)->post(route('admin.borrowings.konfirmasi-pinjam', $borrowing))
            ->assertRedirect(route('admin.borrowings.index'));

        $borrowing->refresh();
        $this->assertSame('dipinjam', $borrowing->status);
        $this->assertSame('2026-09-10', $borrowing->tanggal_pinjam->toDateString());
        $this->assertSame('2026-09-17', $borrowing->tenggat_waktu->toDateString());
        $this->assertSame(0, $book->fresh()->stok);
        Carbon::setTestNow();
    }

    public function test_return_request_uses_request_time_for_fine_not_admin_confirmation_time(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);
        $book = Book::create([
            'judul' => 'Buku Uji',
            'penulis' => 'Penulis Uji',
            'penerbit' => 'Penerbit Uji',
            'stok' => 0,
        ]);
        $borrowing = Borrowing::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'tanggal_pinjam' => '2026-09-01',
            'tanggal_pengajuan_pinjam' => '2026-09-01 08:00:00',
            'tanggal_konfirmasi_pinjam' => '2026-09-01 09:00:00',
            'tenggat_waktu' => '2026-09-05',
            'status' => 'dipinjam',
        ]);

        Carbon::setTestNow('2026-09-05 16:00:00');
        $this->actingAs($user)->post(route('user.kembalikan', $borrowing))
            ->assertRedirect(route('user.riwayat'));

        Carbon::setTestNow('2026-09-10 09:00:00');
        $this->actingAs($admin)->post(route('admin.borrowings.kembalikan', $borrowing))
            ->assertRedirect(route('admin.borrowings.index'));

        $borrowing->refresh();
        $this->assertSame('dikembalikan', $borrowing->status);
        $this->assertSame('2026-09-05', $borrowing->tanggal_kembali->toDateString());
        $this->assertSame(0, $borrowing->denda);
        $this->assertSame(1, $book->fresh()->stok);

        Carbon::setTestNow();
    }
}
