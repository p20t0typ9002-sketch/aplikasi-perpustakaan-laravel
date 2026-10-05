# Web Perpustakaan - Panduan Setup

## Persyaratan
- PHP >= 8.2
- MySQL
- Composer
- Node.js & NPM

## Langkah Setup

### 1. Buat database MySQL
```sql
CREATE DATABASE db_perpus;
```

### 2. Install dependensi
```bash
composer install
npm install
```

### 3. Konfigurasi .env
File `.env` sudah ada. Sesuaikan jika diperlukan:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpus
DB_USERNAME=root
DB_PASSWORD=         # isi password MySQL kamu
```

### 4. Generate app key (jika belum ada)
```bash
php artisan key:generate
```

### 5. Jalankan migrasi & seeder
```bash
php artisan migrate:fresh --seed
```

### 6. Buat storage link (untuk upload cover buku)
```bash
php artisan storage:link
```

### 7. Build assets (Tailwind CSS)
```bash
npm run dev
```
*Atau untuk production:*
```bash
npm run build
```

### 8. Jalankan server
```bash
php artisan serve
```
Akses di: http://localhost:8000

---

## Akun Default (setelah seeder)

| Role  | Email              | Password     |
|-------|--------------------|--------------|
| Admin | admin@perpus.com   | password123  |
| User  | user@perpus.com    | password123  |

> **Admin hanya bisa dibuat via seeder atau Tinker.** Form register hanya untuk pengguna biasa.

Untuk tambah admin baru via Tinker:
```bash
php artisan tinker
```
```php
\App\Models\User::create([
    'name' => 'Admin Baru',
    'email' => 'admin2@perpus.com',
    'password' => \Illuminate\Support\Facades\Hash::make('password'),
    'role' => 'admin',
]);
```

---

## Fitur

### Admin
- Dashboard dengan statistik (total buku, pengguna, peminjaman, denda)
- CRUD buku (dengan upload cover, kategori, tahun terbit)
- Kelola peminjaman: tambah, lihat detail, konfirmasi pengembalian
- Hitung denda otomatis: **Rp 1.000/hari** keterlambatan
- Tandai peminjaman terlambat secara bulk
- Laporan peminjaman per bulan

### Pengguna
- Lihat daftar buku (grid, dengan pencarian & filter kategori)
- Ajukan peminjaman (max 3 buku aktif sekaligus)
- Kembalikan buku (denda dihitung otomatis)
- Riwayat peminjaman

---

## Alur Bisnis

1. User daftar → role otomatis `user`
2. User pilih buku → isi tenggat → klik **Pinjam** → stok berkurang
3. User kembalikan buku → klik **Kembalikan** → stok bertambah, denda dihitung
4. Admin bisa melihat semua peminjaman dan mengkonfirmasi pengembalian secara manual
5. Denda = jumlah hari terlambat × Rp 1.000
