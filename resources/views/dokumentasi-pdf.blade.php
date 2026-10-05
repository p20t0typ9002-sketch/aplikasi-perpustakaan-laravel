<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Pembuatan Aplikasi Web Perpustakaan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #1a1a2e;
            line-height: 1.6;
            background: #ffffff;
        }

        /* ============================================================
           COVER PAGE
        ============================================================ */
        .cover-page {
            page-break-after: always;
            text-align: center;
            padding: 60px 40px;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            color: #ffffff;
            min-height: 800px;
        }

        .cover-logo {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .cover-title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .cover-subtitle {
            font-size: 16px;
            font-weight: 400;
            color: #bfdbfe;
            margin-bottom: 40px;
        }

        .cover-divider {
            width: 80px;
            height: 3px;
            background: #ffffff;
            margin: 20px auto;
        }

        .cover-info {
            margin-top: 40px;
            font-size: 12px;
            color: #bfdbfe;
            line-height: 2;
        }

        .cover-tech-stack {
            margin-top: 30px;
            display: inline-block;
        }

        .tech-badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #ffffff;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 10px;
            margin: 3px;
        }

        .cover-footer {
            position: fixed;
            bottom: 30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: rgba(255,255,255,0.6);
        }

        /* ============================================================
           TOC
        ============================================================ */
        .toc-page {
            page-break-after: always;
            padding: 30px 40px;
        }

        .toc-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3b82f6;
        }

        .toc-item {
            padding: 5px 0;
            border-bottom: 1px dotted #cbd5e1;
            font-size: 10px;
        }

        .toc-item .toc-num {
            display: inline-block;
            width: 30px;
            font-weight: 700;
            color: #3b82f6;
        }

        .toc-item .toc-chapter {
            font-weight: 600;
            color: #1e3a5f;
        }

        .toc-item .toc-sub {
            padding-left: 30px;
            color: #475569;
        }

        /* ============================================================
           GENERAL LAYOUT
        ============================================================ */
        .chapter {
            page-break-before: always;
            padding: 20px 30px;
        }

        .chapter:first-of-type {
            page-break-before: auto;
        }

        .chapter-header {
            background: #1e3a5f;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .chapter-header .chapter-num {
            font-size: 10px;
            color: #93c5fd;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .chapter-header h1 {
            font-size: 18px;
            font-weight: 700;
        }

        h2 {
            font-size: 13px;
            font-weight: 700;
            color: #1e3a5f;
            margin: 16px 0 8px 0;
            padding-left: 10px;
            border-left: 3px solid #3b82f6;
        }

        h3 {
            font-size: 11px;
            font-weight: 700;
            color: #2563eb;
            margin: 12px 0 6px 0;
        }

        h4 {
            font-size: 10px;
            font-weight: 700;
            color: #374151;
            margin: 8px 0 4px 0;
            text-decoration: underline;
        }

        p {
            margin-bottom: 8px;
            text-align: justify;
            font-size: 10px;
        }

        ul, ol {
            margin: 6px 0 10px 20px;
            font-size: 10px;
        }

        li {
            margin-bottom: 3px;
        }

        /* ============================================================
           CODE BLOCKS
        ============================================================ */
        .code-block {
            background: #1e293b;
            color: #e2e8f0;
            padding: 12px 15px;
            border-radius: 6px;
            font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
            font-size: 8.5px;
            line-height: 1.5;
            margin: 8px 0 12px 0;
            overflow: hidden;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .code-block .code-title {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9px;
            color: #94a3b8;
            font-style: italic;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid #334155;
        }

        .code-inline {
            background: #f1f5f9;
            color: #be185d;
            padding: 1px 5px;
            border-radius: 3px;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 8.5px;
        }

        /* ============================================================
           CALLOUT BOXES
        ============================================================ */
        .callout {
            padding: 10px 14px;
            border-radius: 6px;
            margin: 10px 0;
            font-size: 9.5px;
        }

        .callout-info {
            background: #eff6ff;
            border-left: 3px solid #3b82f6;
            color: #1e40af;
        }

        .callout-warning {
            background: #fffbeb;
            border-left: 3px solid #f59e0b;
            color: #92400e;
        }

        .callout-success {
            background: #f0fdf4;
            border-left: 3px solid #22c55e;
            color: #166534;
        }

        .callout-danger {
            background: #fef2f2;
            border-left: 3px solid #ef4444;
            color: #991b1b;
        }

        /* ============================================================
           TABLES
        ============================================================ */
        table.doc-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 12px 0;
            font-size: 9.5px;
        }

        table.doc-table th {
            background: #1e3a5f;
            color: #ffffff;
            padding: 7px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table.doc-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        table.doc-table tr:nth-child(even) td {
            background: #f8fafc;
        }

        /* ============================================================
           STEP INDICATOR
        ============================================================ */
        .step-list {
            margin: 8px 0;
        }

        .step-item {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .step-num {
            display: table-cell;
            width: 28px;
            height: 28px;
            background: #3b82f6;
            color: #ffffff;
            font-weight: 700;
            font-size: 11px;
            text-align: center;
            vertical-align: middle;
            border-radius: 50%;
        }

        .step-content {
            display: table-cell;
            vertical-align: top;
            padding-left: 12px;
        }

        .step-content strong {
            display: block;
            font-size: 10px;
            color: #1e3a5f;
            margin-bottom: 2px;
        }

        .step-content p {
            font-size: 9.5px;
            color: #374151;
            margin-bottom: 0;
        }

        /* ============================================================
           FILE TREE
        ============================================================ */
        .file-tree {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 15px;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 8.5px;
            line-height: 1.8;
            margin: 8px 0;
            color: #374151;
        }

        .file-tree .dir {
            color: #2563eb;
            font-weight: 700;
        }

        .file-tree .file {
            color: #374151;
        }

        /* ============================================================
           FOOTER / HEADER
        ============================================================ */
        .page-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 25px;
            border-top: 1px solid #e2e8f0;
            font-size: 8px;
            color: #94a3b8;
            padding: 0 30px;
        }

        .page-footer table {
            width: 100%;
        }

        .badge-status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8.5px;
            font-weight: 600;
        }

        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-red { background: #fee2e2; color: #991b1b; }

        .section-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 15px 0;
        }

        .highlight-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            padding: 10px 14px;
            margin: 8px 0;
            font-size: 9.5px;
        }
    </style>
</head>
<body>

<!-- ================================================================
     COVER PAGE
================================================================ -->
<div class="cover-page">
    <div class="cover-logo">📚</div>
    <div class="cover-title">Modul Pembuatan</div>
    <div class="cover-title">Aplikasi Web Perpustakaan</div>
    <div class="cover-divider"></div>
    <div class="cover-subtitle">Panduan lengkap dari instalasi hingga deployment</div>

    <div class="cover-tech-stack">
        <span class="tech-badge">PHP 8.3</span>
        <span class="tech-badge">Laravel 13</span>
        <span class="tech-badge">SQLite</span>
        <span class="tech-badge">Tailwind CSS</span>
        <span class="tech-badge">DomPDF</span>
        <span class="tech-badge">Laravel Breeze</span>
    </div>

    <div class="cover-info">
        <p style="color:#bfdbfe; font-size:11px; margin-top:30px;">
            Aplikasi manajemen perpustakaan berbasis web dengan fitur peminjaman buku,<br>
            konfirmasi admin, sistem denda, dan laporan PDF.
        </p>
    </div>

    <div class="cover-footer">
        Dicetak pada: {{ now()->format('d F Y') }} &nbsp;&bull;&nbsp; Versi 1.0
    </div>
</div>

<!-- ================================================================
     DAFTAR ISI
================================================================ -->
<div class="toc-page">
    <div class="toc-title">📋 Daftar Isi</div>

    <div class="toc-item"><span class="toc-num">1.</span><span class="toc-chapter">Gambaran Umum Aplikasi</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;1.1 Fitur-fitur Utama</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;1.2 Struktur Direktori Proyek</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;1.3 Alur Kerja Aplikasi</div>

    <div class="toc-item"><span class="toc-num">2.</span><span class="toc-chapter">Persiapan & Instalasi</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;2.1 Kebutuhan Sistem</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;2.2 Instalasi Laravel & Paket</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;2.3 Konfigurasi Environment</div>

    <div class="toc-item"><span class="toc-num">3.</span><span class="toc-chapter">Database & Migrasi</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;3.1 Migration: Tabel Users</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;3.2 Migration: Tabel Books</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;3.3 Migration: Tabel Borrowings</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;3.4 Migration: Tambah Kolom Konfirmasi</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;3.5 Database Seeder</div>

    <div class="toc-item"><span class="toc-num">4.</span><span class="toc-chapter">Model (Eloquent)</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;4.1 Model User</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;4.2 Model Book</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;4.3 Model Borrowing</div>

    <div class="toc-item"><span class="toc-num">5.</span><span class="toc-chapter">Middleware</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;5.1 Middleware IsAdmin</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;5.2 Registrasi Middleware</div>

    <div class="toc-item"><span class="toc-num">6.</span><span class="toc-chapter">Routes (Routing)</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;6.1 routes/web.php</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;6.2 routes/auth.php</div>

    <div class="toc-item"><span class="toc-num">7.</span><span class="toc-chapter">Controller</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;7.1 AdminController</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;7.2 Admin\BookController</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;7.3 Admin\BorrowingController</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;7.4 BorrowingController (User)</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;7.5 DocumentasiController</div>

    <div class="toc-item"><span class="toc-num">8.</span><span class="toc-chapter">View (Blade Templates)</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.1 Layout Utama (app.blade.php)</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.2 Navigasi</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.3 Halaman Login & Register</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.4 Dashboard Admin</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.5 CRUD Buku (Admin)</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.6 Manajemen Peminjaman (Admin)</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;8.7 Dashboard & Halaman User</div>

    <div class="toc-item"><span class="toc-num">9.</span><span class="toc-chapter">Cara Menjalankan Aplikasi</span></div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;9.1 Langkah Setup Lengkap</div>
    <div class="toc-item toc-sub">&nbsp;&nbsp;&nbsp;9.2 Akun Default</div>

    <div class="toc-item"><span class="toc-num">10.</span><span class="toc-chapter">Referensi & Penutup</span></div>
</div>


<!-- ================================================================
     BAB 1: GAMBARAN UMUM
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 1</div>
        <h1>Gambaran Umum Aplikasi</h1>
    </div>

    <p>Aplikasi Web Perpustakaan ini adalah sistem manajemen peminjaman buku berbasis web yang dibangun menggunakan framework Laravel. Sistem ini dirancang untuk memudahkan proses peminjaman dan pengembalian buku di perpustakaan, dengan dua peran pengguna: <strong>Admin</strong> dan <strong>Anggota (User)</strong>.</p>

    <h2>1.1 Fitur-fitur Utama</h2>

    <table class="doc-table">
        <thead>
            <tr>
                <th>Fitur</th>
                <th>Admin</th>
                <th>User/Anggota</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Login & Register</td>
                <td>✅</td>
                <td>✅</td>
            </tr>
            <tr>
                <td>Dashboard statistik</td>
                <td>✅ (lengkap)</td>
                <td>✅ (ringkas)</td>
            </tr>
            <tr>
                <td>Manajemen buku (CRUD)</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Upload cover buku</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Lihat daftar buku</td>
                <td>✅</td>
                <td>✅</td>
            </tr>
            <tr>
                <td>Ajukan peminjaman buku</td>
                <td>❌</td>
                <td>✅</td>
            </tr>
            <tr>
                <td>Konfirmasi pengajuan pinjam</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Ajukan pengembalian buku</td>
                <td>❌</td>
                <td>✅</td>
            </tr>
            <tr>
                <td>Konfirmasi & hitung denda</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Laporan peminjaman bulanan</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Export laporan PDF</td>
                <td>✅</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Riwayat peminjaman</td>
                <td>✅ (semua)</td>
                <td>✅ (milik sendiri)</td>
            </tr>
        </tbody>
    </table>

    <h2>1.2 Struktur Direktori Proyek</h2>

    <div class="file-tree">
<span class="dir">web-perpustakaan/</span>
├── <span class="dir">app/</span>
│   ├── <span class="dir">Http/</span>
│   │   ├── <span class="dir">Controllers/</span>
│   │   │   ├── <span class="dir">Admin/</span>
│   │   │   │   ├── <span class="file">BookController.php</span>      ← CRUD buku oleh admin
│   │   │   │   └── <span class="file">BorrowingController.php</span>  ← Manajemen peminjaman admin
│   │   │   ├── <span class="file">AdminController.php</span>          ← Dashboard admin
│   │   │   ├── <span class="file">BorrowingController.php</span>      ← Fitur pinjam untuk user
│   │   │   ├── <span class="file">DocumentasiController.php</span>   ← Generate PDF dokumentasi
│   │   │   └── <span class="file">ProfileController.php</span>        ← Edit profil
│   │   └── <span class="dir">Middleware/</span>
│   │       └── <span class="file">IsAdmin.php</span>                   ← Guard akses admin
│   └── <span class="dir">Models/</span>
│       ├── <span class="file">User.php</span>
│       ├── <span class="file">Book.php</span>
│       └── <span class="file">Borrowing.php</span>
├── <span class="dir">database/</span>
│   ├── <span class="dir">migrations/</span>                            ← Skema database
│   └── <span class="dir">seeders/</span>
│       └── <span class="file">DatabaseSeeder.php</span>               ← Data awal
├── <span class="dir">resources/views/</span>
│   ├── <span class="dir">admin/</span>                                 ← View khusus admin
│   ├── <span class="dir">user/</span>                                  ← View khusus user
│   ├── <span class="dir">layouts/</span>                               ← Layout utama
│   └── <span class="dir">auth/</span>                                  ← Login & register
└── <span class="dir">routes/</span>
    ├── <span class="file">web.php</span>                               ← Routing utama
    └── <span class="file">auth.php</span>                              ← Routing autentikasi
    </div>

    <h2>1.3 Alur Kerja Aplikasi</h2>

    <div class="step-list">
        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-content">
                <strong>User mendaftar / login</strong>
                <p>Pengguna baru dapat mendaftar akun. Secara default role adalah "user". Admin dibuat langsung dari seeder.</p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-content">
                <strong>User mengajukan peminjaman</strong>
                <p>User memilih buku dan menentukan tanggal pengembalian. Batas maks 3 buku aktif sekaligus. Status awal: <span class="badge-status badge-yellow">menunggu_konfirmasi_pinjam</span></p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-content">
                <strong>Admin mengkonfirmasi peminjaman</strong>
                <p>Admin melihat pengajuan dan mengkonfirmasi. Stok buku berkurang 1. Status berubah: <span class="badge-status badge-blue">dipinjam</span></p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">4</div>
            <div class="step-content">
                <strong>User mengajukan pengembalian</strong>
                <p>User klik tombol "Kembalikan". Tanggal pengajuan dicatat. Status: <span class="badge-status badge-yellow">menunggu_konfirmasi_kembali</span></p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">5</div>
            <div class="step-content">
                <strong>Admin mengkonfirmasi pengembalian</strong>
                <p>Admin mengkonfirmasi. Denda dihitung Rp 1.000/hari jika terlambat. Stok buku bertambah 1. Status: <span class="badge-status badge-green">dikembalikan</span></p>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     BAB 2: PERSIAPAN & INSTALASI
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 2</div>
        <h1>Persiapan &amp; Instalasi</h1>
    </div>

    <h2>2.1 Kebutuhan Sistem</h2>

    <table class="doc-table">
        <thead>
            <tr><th>Software</th><th>Versi Minimum</th><th>Keterangan</th></tr>
        </thead>
        <tbody>
            <tr><td>PHP</td><td>8.3+</td><td>Wajib, dengan ekstensi: pdo, mbstring, openssl, tokenizer, xml</td></tr>
            <tr><td>Composer</td><td>2.x</td><td>Manajemen dependensi PHP</td></tr>
            <tr><td>Node.js</td><td>18+</td><td>Untuk build asset Tailwind CSS via Vite</td></tr>
            <tr><td>NPM</td><td>9+</td><td>Paket manager JavaScript</td></tr>
            <tr><td>SQLite</td><td>3.x</td><td>Database default (file-based, tidak perlu install server DB)</td></tr>
            <tr><td>Web Server</td><td>-</td><td>Apache/Nginx atau gunakan built-in <code>php artisan serve</code></td></tr>
        </tbody>
    </table>

    <div class="callout callout-info">
        <strong>💡 Catatan:</strong> Proyek ini menggunakan SQLite sebagai database. SQLite tidak memerlukan instalasi server database terpisah — cukup PHP dengan ekstensi pdo_sqlite yang sudah aktif.
    </div>

    <h2>2.2 Instalasi Laravel &amp; Paket</h2>

    <h3>Langkah 1: Buat proyek baru Laravel</h3>
    <div class="code-block"><div class="code-title">Terminal / Command Prompt</div>composer create-project laravel/laravel web-perpustakaan
cd web-perpustakaan</div>

    <h3>Langkah 2: Install Laravel Breeze (autentikasi)</h3>
    <div class="code-block"><div class="code-title">Terminal</div>composer require laravel/breeze --dev
php artisan breeze:install blade --no-interaction</div>

    <h3>Langkah 3: Install DomPDF (untuk generate PDF)</h3>
    <div class="code-block"><div class="code-title">Terminal</div>composer require barryvdh/laravel-dompdf</div>

    <h3>Langkah 4: Install dependensi Node.js</h3>
    <div class="code-block"><div class="code-title">Terminal</div>npm install</div>

    <h2>2.3 Konfigurasi Environment (.env)</h2>

    <p>Salin file <code>.env.example</code> menjadi <code>.env</code>, lalu sesuaikan:</p>

    <div class="code-block"><div class="code-title">.env</div>APP_NAME="Perpustakaan"
APP_ENV=local
APP_KEY=                         # diisi otomatis saat php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD → tidak perlu untuk SQLite

BCRYPT_ROUNDS=12</div>

    <h3>Generate App Key</h3>
    <div class="code-block"><div class="code-title">Terminal</div># Buat file .env (jika belum ada)
cp .env.example .env

# Generate key enkripsi aplikasi
php artisan key:generate

# Buat file database SQLite
touch database/database.sqlite
# Atau di Windows:
# New-Item database\database.sqlite -ItemType File</div>

    <h3>Tambahkan Middleware IsAdmin ke bootstrap/app.php</h3>
    <p>Buka <code class="code-inline">bootstrap/app.php</code> dan daftarkan middleware alias:</p>

    <div class="code-block"><div class="code-title">bootstrap/app.php</div>&lt;?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();</div>
</div>

<!-- ================================================================
     BAB 3: DATABASE & MIGRASI
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 3</div>
        <h1>Database &amp; Migrasi</h1>
    </div>

    <p>Jalankan semua migrasi dengan perintah:</p>
    <div class="code-block"><div class="code-title">Terminal</div>php artisan migrate
php artisan db:seed   # isi data awal (buku & akun admin/user)</div>

    <h2>3.1 Migration: Tabel Users</h2>
    <p>File: <code class="code-inline">database/migrations/0001_01_01_000000_create_users_table.php</code></p>

    <div class="code-block"><div class="code-title">create_users_table.php</div>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user'); // ← tambahan
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};</div>

    <h2>3.2 Migration: Tabel Books</h2>
    <p>File: <code class="code-inline">database/migrations/2026_09_01_011508_create_books_table.php</code></p>

    <div class="code-block"><div class="code-title">create_books_table.php</div>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('kategori')->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->integer('stok');
            $table->string('cover')->nullable();  // path file gambar cover
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};</div>

    <h2>3.3 Migration: Tabel Borrowings</h2>
    <p>File: <code class="code-inline">database/migrations/2026_09_01_011907_create_borrowings_table.php</code></p>

    <div class="code-block"><div class="code-title">create_borrowings_table.php</div>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');

            $table->date('tanggal_pinjam')->nullable();
            $table->date('tenggat_waktu');
            $table->date('tanggal_kembali')->nullable();

            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');
            $table->integer('denda')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};</div>

    <h2>3.4 Migration: Tambah Kolom Konfirmasi</h2>
    <p>File: <code class="code-inline">database/migrations/2026_09_09_043244_add_confirmation_timestamps_to_borrowings_table.php</code></p>

    <div class="code-block"><div class="code-title">add_confirmation_timestamps_to_borrowings_table.php</div>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->timestamp('tanggal_pengajuan_pinjam')->nullable()->after('tanggal_pinjam');
            $table->timestamp('tanggal_konfirmasi_pinjam')->nullable()->after('tanggal_pengajuan_pinjam');
            $table->timestamp('tanggal_pengajuan_kembali')->nullable()->after('tanggal_kembali');
            $table->timestamp('tanggal_konfirmasi_kembali')->nullable()->after('tanggal_pengajuan_kembali');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_pengajuan_pinjam',
                'tanggal_konfirmasi_pinjam',
                'tanggal_pengajuan_kembali',
                'tanggal_konfirmasi_kembali',
            ]);
        });
    }
};</div>

    <p>File: <code class="code-inline">database/migrations/2026_09_09_054926_expand_borrowing_statuses_for_admin_confirmation.php</code></p>

    <div class="code-block"><div class="code-title">expand_borrowing_statuses_for_admin_confirmation.php</div>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite tidak mendukung ALTER COLUMN untuk ENUM,
        // jadi kita buat kolom baru sebagai string dan drop yang lama
        Schema::table('borrowings', function (Blueprint $table) {
            $table->string('status_new')->default('dipinjam')->after('status');
        });

        // Salin data lama
        \DB::table('borrowings')->update([
            'status_new' => \DB::raw('status'),
        ]);

        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('borrowings', function (Blueprint $table) {
            $table->renameColumn('status_new', 'status');
        });
    }

    public function down(): void
    {
        // Rollback: kembalikan ke enum semula
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status_baru', ['dipinjam', 'dikembalikan', 'terlambat'])
                ->default('dipinjam')->after('status');
        });
        \DB::table('borrowings')->update([
            'status_baru' => \DB::raw("CASE
                WHEN status IN ('dipinjam','dikembalikan','terlambat') THEN status
                ELSE 'dipinjam'
            END"),
        ]);
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->renameColumn('status_baru', 'status');
        });
    }
};</div>

    <h2>3.5 Database Seeder</h2>
    <p>File: <code class="code-inline">database/seeders/DatabaseSeeder.php</code></p>

    <div class="code-block"><div class="code-title">DatabaseSeeder.php</div>&lt;?php

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

        // Buat akun user demo
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
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(['judul' => $book['judul']], $book);
        }
    }
}</div>
</div>

<!-- ================================================================
     BAB 4: MODEL
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 4</div>
        <h1>Model (Eloquent)</h1>
    </div>

    <h2>4.1 Model User</h2>
    <p>File: <code class="code-inline">app/Models/User.php</code></p>

    <div class="code-block"><div class="code-title">app/Models/User.php</div>&lt;?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Relasi: satu user punya banyak peminjaman
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Peminjaman yang masih aktif
     */
    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)->where('status', 'dipinjam');
    }
}</div>

    <h2>4.2 Model Book</h2>
    <p>File: <code class="code-inline">app/Models/Book.php</code></p>

    <div class="code-block"><div class="code-title">app/Models/Book.php</div>&lt;?php

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
}</div>

    <h2>4.3 Model Borrowing</h2>
    <p>File: <code class="code-inline">app/Models/Borrowing.php</code></p>

    <div class="code-block"><div class="code-title">app/Models/Borrowing.php</div>&lt;?php

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
        'tanggal_pinjam'              => 'date',
        'tanggal_pengajuan_pinjam'    => 'datetime',
        'tanggal_konfirmasi_pinjam'   => 'datetime',
        'tenggat_waktu'               => 'date',
        'tanggal_kembali'             => 'date',
        'tanggal_pengajuan_kembali'   => 'datetime',
        'tanggal_konfirmasi_kembali'  => 'datetime',
    ];

    /** Relasi ke User */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi ke Book */
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

        $terlambat = $this->tenggat_waktu
            ->diffInDays($this->tanggal_kembali->copy()->startOfDay(), false);

        if ($terlambat <= 0) {
            return 0;
        }

        return $terlambat * 1000; // Rp 1.000 per hari
    }

    /**
     * Scope: peminjaman yang sedang aktif
     */
    public function scopeAktif($query)
    {
        return $query->whereIn('status', [
            'dipinjam', 'terlambat', 'menunggu_konfirmasi_kembali'
        ]);
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
}</div>
</div>

<!-- ================================================================
     BAB 5: MIDDLEWARE
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 5</div>
        <h1>Middleware</h1>
    </div>

    <h2>5.1 Middleware IsAdmin</h2>
    <p>Middleware ini memproteksi semua route admin agar hanya dapat diakses oleh pengguna dengan role <code class="code-inline">admin</code>.</p>
    <p>File: <code class="code-inline">app/Http/Middleware/IsAdmin.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Middleware/IsAdmin.php</div>&lt;?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/dashboard')
            ->with('error', 'Anda tidak memiliki akses ke halaman Admin.');
    }
}</div>

    <h2>5.2 Registrasi Middleware di bootstrap/app.php</h2>
    <p>Daftarkan alias <code class="code-inline">admin</code> agar bisa dipakai di route.</p>

    <div class="code-block"><div class="code-title">bootstrap/app.php (bagian withMiddleware)</div>->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})</div>

    <p>Setelah terdaftar, middleware ini digunakan di route seperti:</p>
    <div class="code-block"><div class="code-title">routes/web.php</div>Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // semua route admin di sini aman dari akses publik
});</div>
</div>

<!-- ================================================================
     BAB 6: ROUTES
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 6</div>
        <h1>Routes (Routing)</h1>
    </div>

    <h2>6.1 routes/web.php</h2>

    <div class="code-block"><div class="code-title">routes/web.php</div>&lt;?php

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

// DOKUMENTASI PDF
Route::get('/dokumentasi', [DocumentasiController::class, 'preview'])->name('dokumentasi.preview');
Route::get('/dokumentasi/download', [DocumentasiController::class, 'download'])->name('dokumentasi.download');

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── ADMIN ROUTES ─────────────────────────────────────────────────
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
    Route::post('/borrowings/{borrowing}/konfirmasi-pinjam', [AdminBorrowingController::class, 'konfirmasiPinjam'])
         ->name('borrowings.konfirmasi-pinjam');
    Route::post('/borrowings/{borrowing}/kembalikan', [AdminBorrowingController::class, 'kembalikan'])
         ->name('borrowings.kembalikan');
    Route::post('/borrowings/tandai-terlambat', [AdminBorrowingController::class, 'tandaiTerlambat'])
         ->name('borrowings.tandai-terlambat');
    Route::delete('/borrowings/{borrowing}', [AdminBorrowingController::class, 'destroy'])
         ->name('borrowings.destroy');

    // Laporan
    Route::get('/laporan', [AdminBorrowingController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/export-pdf', [AdminBorrowingController::class, 'exportPdf'])->name('laporan.export-pdf');
});

// ─── USER ROUTES ──────────────────────────────────────────────────
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Dashboard pengguna
    Route::get('/dashboard', function () {
        $activeBorrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->get();
        return view('user.dashboard', compact('activeBorrowings'));
    })->name('dashboard');

    // Daftar & detail buku
    Route::get('/books', [BorrowingController::class, 'daftarBuku'])->name('books');
    Route::get('/books/{book}', [BorrowingController::class, 'detailBuku'])->name('books.show');

    // Pinjam buku
    Route::post('/pinjam', [BorrowingController::class, 'ajukanPinjam'])->name('pinjam');

    // Riwayat peminjaman
    Route::get('/riwayat', [BorrowingController::class, 'riwayat'])->name('riwayat');

    // Kembalikan buku
    Route::post('/kembalikan/{borrowing}', [BorrowingController::class, 'ajukanKembali'])->name('kembalikan');
});

// ─── PROFILE ──────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';</div>
</div>

<!-- ================================================================
     BAB 7: CONTROLLER
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 7</div>
        <h1>Controller</h1>
    </div>

    <h2>7.1 AdminController — Dashboard Admin</h2>
    <p>File: <code class="code-inline">app/Http/Controllers/AdminController.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Controllers/AdminController.php</div>&lt;?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalBuku      = Book::count();
        $totalPengguna  = User::where('role', 'user')->count();
        $totalDipinjam  = Borrowing::where('status', 'dipinjam')->count();
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
}</div>

    <h2>7.2 Admin\BookController — CRUD Buku</h2>
    <p>File: <code class="code-inline">app/Http/Controllers/Admin/BookController.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Controllers/Admin/BookController.php</div>&lt;?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
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

        $books    = $query->latest()->paginate(15);
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('admin.books.index', compact('books', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();
        return view('admin.books.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'kategori'     => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.date('Y'),
            'stok'         => 'required|integer|min:0',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('cover');
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        $borrowings = $book->borrowings()->with('user')->latest()->paginate(10);
        return view('admin.books.show', compact('book', 'borrowings'));
    }

    public function edit(Book $book)
    {
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();
        return view('admin.books.edit', compact('book', 'kategoris'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'kategori'     => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.date('Y'),
            'stok'         => 'required|integer|min:0',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('cover');
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        $aktif = $book->borrowings()->whereIn('status', ['dipinjam', 'terlambat'])->count();
        if ($aktif > 0) {
            return back()->with('error', 'Buku tidak bisa dihapus karena masih ada yang meminjam.');
        }

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}</div>

    <h2>7.3 Admin\BorrowingController — Manajemen Peminjaman</h2>
    <p>File: <code class="code-inline">app/Http/Controllers/Admin/BorrowingController.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Controllers/Admin/BorrowingController.php</div>&lt;?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('book', fn ($b) => $b->where('judul', 'like', "%{$search}%"));
            });
        }

        $borrowings = $query->latest()->paginate(15);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        $books = Book::where('stok', '>', 0)->orderBy('judul')->get();
        return view('admin.borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'book_id'        => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tenggat_waktu'  => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->book_id);
        if ($book->stok <= 0) {
            return back()->withErrors(['book_id' => 'Stok buku tidak tersedia.'])->withInput();
        }

        Borrowing::create([
            'user_id'        => $request->user_id,
            'book_id'        => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_waktu'  => $request->tenggat_waktu,
            'status'         => 'dipinjam',
            'denda'          => 0,
        ]);

        $book->decrement('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['user', 'book']);
        return view('admin.borrowings.show', compact('borrowing'));
    }

    public function konfirmasiPinjam(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'menunggu_konfirmasi_pinjam') {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        $book = $borrowing->book;
        if ($book->stok <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $durasiPeminjaman = max(1, $borrowing->tanggal_pengajuan_pinjam
            ->startOfDay()->diffInDays($borrowing->tenggat_waktu, false));
        $tanggalPinjam = now();

        $borrowing->update([
            'tanggal_pinjam'           => $tanggalPinjam->toDateString(),
            'tanggal_konfirmasi_pinjam' => $tanggalPinjam,
            'tenggat_waktu'            => $tanggalPinjam->copy()->addDays($durasiPeminjaman)->toDateString(),
            'status'                   => 'dipinjam',
        ]);

        $book->decrement('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    public function kembalikan(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'menunggu_konfirmasi_kembali') {
            return back()->with('error', 'Pengembalian harus diajukan user terlebih dahulu.');
        }

        $tanggalKembali = $borrowing->tanggal_pengajuan_kembali;

        $denda     = 0;
        $terlambat = $borrowing->tenggat_waktu
            ->diffInDays($tanggalKembali->copy()->startOfDay(), false);
        if ($terlambat > 0) {
            $denda = $terlambat * 1000;
        }

        $borrowing->update([
            'tanggal_kembali'          => $tanggalKembali->toDateString(),
            'tanggal_konfirmasi_kembali' => now(),
            'status'                   => 'dikembalikan',
            'denda'                    => $denda,
        ]);

        $borrowing->book->increment('stok');

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan'
                .($denda > 0 ? ' dengan denda Rp '.number_format($denda, 0, ',', '.') : '').'.');
    }

    public function tandaiTerlambat()
    {
        $jumlah = Borrowing::whereIn('status', ['dipinjam', 'terlambat'])
            ->where('tenggat_waktu', '<', now()->toDateString())
            ->update(['status' => 'terlambat']);

        return back()->with('success', "{$jumlah} peminjaman ditandai terlambat.");
    }

    public function laporan(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data = Borrowing::with(['user', 'book'])
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulan)
            ->get();

        $totalPeminjaman  = $data->count();
        $totalDikembalikan = $data->where('status', 'dikembalikan')->count();
        $totalTerlambat   = $data->whereIn('status', ['terlambat', 'dikembalikan'])
            ->where('denda', '>', 0)->count();
        $totalDenda = $data->sum('denda');

        // Data per 12 bulan terakhir untuk chart
        $perBulan = [];
        for ($i = 11; $i >= 0; $i--) {
            $t = now()->subMonths($i);
            $perBulan[] = [
                'label' => $t->translatedFormat('M Y'),
                'jumlah' => Borrowing::whereYear('tanggal_pinjam', $t->year)
                    ->whereMonth('tanggal_pinjam', $t->month)->count(),
            ];
        }

        return view('admin.borrowings.laporan', compact(
            'data', 'totalPeminjaman', 'totalDikembalikan',
            'totalTerlambat', 'totalDenda', 'perBulan', 'bulan', 'tahun'
        ));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data = Borrowing::with(['user', 'book'])
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulan)
            ->get();

        $totalPeminjaman  = $data->count();
        $totalDikembalikan = $data->where('status', 'dikembalikan')->count();
        $totalTerlambat   = $data->whereIn('status', ['terlambat', 'dikembalikan'])
            ->where('denda', '>', 0)->count();
        $totalDenda = $data->sum('denda');
        $namaBulan  = \Carbon\Carbon::create(null, $bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('admin.borrowings.laporan-pdf', compact(
            'data', 'totalPeminjaman', 'totalDikembalikan',
            'totalTerlambat', 'totalDenda', 'bulan', 'tahun', 'namaBulan'
        ));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download("laporan-peminjaman-{$namaBulan}-{$tahun}.pdf");
    }

    public function destroy(Borrowing $borrowing)
    {
        if (in_array($borrowing->status, ['dipinjam', 'terlambat', 'menunggu_konfirmasi_kembali'], true)) {
            $borrowing->book->increment('stok');
        }

        $borrowing->delete();

        return redirect()->route('admin.borrowings.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}</div>

    <h2>7.4 BorrowingController (User)</h2>
    <p>File: <code class="code-inline">app/Http/Controllers/BorrowingController.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Controllers/BorrowingController.php</div>&lt;?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
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

        $books    = $query->latest()->paginate(12);
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('user.books.index', compact('books', 'kategoris'));
    }

    public function detailBuku(Book $book)
    {
        $sedangMeminjam = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', '!=', 'dikembalikan')
            ->exists();

        return view('user.books.show', compact('book', 'sedangMeminjam'));
    }

    public function ajukanPinjam(Request $request)
    {
        $request->validate([
            'book_id'       => 'required|exists:books,id',
            'tenggat_waktu' => [
                'required', 'date', 'after:today',
                'before_or_equal:'.now()->addDays(30)->toDateString()
            ],
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku sudah habis.');
        }

        $sudahMeminjam = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', '!=', 'dikembalikan')
            ->exists();

        if ($sudahMeminjam) {
            return back()->with('error', 'Kamu sudah meminjam buku ini dan belum mengembalikannya.');
        }

        $jumlahAktif = Borrowing::where('user_id', auth()->id())
            ->where('status', '!=', 'dikembalikan')
            ->count();

        if ($jumlahAktif >= 3) {
            return back()->with('error', 'Kamu sudah meminjam 3 buku. Kembalikan dulu sebelum meminjam lagi.');
        }

        Borrowing::create([
            'user_id'                 => auth()->id(),
            'book_id'                 => $book->id,
            'tenggat_waktu'           => $request->tenggat_waktu,
            'tanggal_pengajuan_pinjam' => now(),
            'status'                  => 'menunggu_konfirmasi_pinjam',
            'denda'                   => 0,
        ]);

        return redirect()->route('user.riwayat')
            ->with('success', "Pengajuan pinjam \"{$book->judul}\" menunggu konfirmasi admin.");
    }

    public function riwayat()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.borrowings.riwayat', compact('borrowings'));
    }

    public function ajukanKembali(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan.');
        }

        if (! in_array($borrowing->status, ['dipinjam', 'terlambat'], true)) {
            return back()->with('error', 'Pengembalian tidak dapat diajukan untuk status ini.');
        }

        $borrowing->update([
            'tanggal_pengajuan_kembali' => now(),
            'status'                    => 'menunggu_konfirmasi_kembali',
        ]);

        return redirect()->route('user.riwayat')
            ->with('success', 'Pengajuan pengembalian telah dicatat. Denda dihitung dari tanggal ini.');
    }
}</div>

    <h2>7.5 DocumentasiController</h2>
    <p>File: <code class="code-inline">app/Http/Controllers/DocumentasiController.php</code></p>

    <div class="code-block"><div class="code-title">app/Http/Controllers/DocumentasiController.php</div>&lt;?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class DocumentasiController extends Controller
{
    /**
     * Tampilkan preview dokumentasi langsung di browser.
     */
    public function preview(): Response
    {
        $pdf = Pdf::loadView('dokumentasi-pdf');
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('dokumentasi-proyek-perpustakaan.pdf');
    }

    /**
     * Download PDF dokumentasi proyek.
     */
    public function download(): Response
    {
        $pdf = Pdf::loadView('dokumentasi-pdf');
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('dokumentasi-proyek-perpustakaan.pdf');
    }
}</div>
</div>

<!-- ================================================================
     BAB 8: VIEW (BLADE TEMPLATES) - Ringkas
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 8</div>
        <h1>View (Blade Templates)</h1>
    </div>

    <p>Aplikasi ini menggunakan Blade sebagai template engine. Semua view tersimpan di folder <code class="code-inline">resources/views/</code>. Berikut struktur view yang perlu dibuat:</p>

    <h2>8.1 Layout Utama</h2>
    <p>File: <code class="code-inline">resources/views/layouts/app.blade.php</code></p>

    <div class="code-block"><div class="code-title">resources/views/layouts/app.blade.php</div>&lt;!DOCTYPE html&gt;
&lt;html lang="@{{ str_replace('_', '-', app()->getLocale()) }}"&gt;
&lt;head&gt;
    &lt;meta charset="utf-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;
    &lt;meta name="csrf-token" content="@{{ csrf_token() }}"&gt;
    &lt;title&gt;@{{ config('app.name', 'Perpustakaan') }}&lt;/title&gt;
    &lt;link rel="preconnect" href="https://fonts.bunny.net"&gt;
    &lt;link href="https://fonts.bunny.net/css?family=figtree:400,500,600&amp;amp;display=swap" rel="stylesheet" /&gt;
    @@vite(['resources/css/app.css', 'resources/js/app.js'])
&lt;/head&gt;
&lt;body class="font-sans antialiased"&gt;
    &lt;div class="min-h-screen bg-gray-100"&gt;
        @@include('layouts.navigation')
        @@isset($header)
            &lt;header class="bg-white shadow"&gt;
                &lt;div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"&gt;
                    @{{ $header }}
                &lt;/div&gt;
            &lt;/header&gt;
        @@endisset
        &lt;main&gt;@{{ $slot }}&lt;/main&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</div>

    <h2>8.2 Halaman Login</h2>
    <p>File: <code class="code-inline">resources/views/auth/login.blade.php</code></p>

    <div class="code-block"><div class="code-title">resources/views/auth/login.blade.php</div>&lt;x-guest-layout&gt;
    &lt;x-auth-session-status class="mb-4" :status="session('status')" /&gt;

    &lt;form method="POST" action="@{{ route('login') }}"&gt;
        @@csrf

        &lt;div&gt;
            &lt;x-input-label for="email" value="Email" /&gt;
            &lt;x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autofocus /&gt;
            &lt;x-input-error :messages="$errors-&gt;get('email')" class="mt-2" /&gt;
        &lt;/div&gt;

        &lt;div class="mt-4"&gt;
            &lt;x-input-label for="password" value="Password" /&gt;
            &lt;x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required /&gt;
            &lt;x-input-error :messages="$errors-&gt;get('password')" class="mt-2" /&gt;
        &lt;/div&gt;

        &lt;div class="block mt-4"&gt;
            &lt;label for="remember_me" class="inline-flex items-center"&gt;
                &lt;input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600"&gt;
                &lt;span class="ms-2 text-sm text-gray-600"&gt;Ingat saya&lt;/span&gt;
            &lt;/label&gt;
        &lt;/div&gt;

        &lt;div class="flex items-center justify-end mt-4"&gt;
            @@if (Route::has('password.request'))
                &lt;a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="@{{ route('password.request') }}"&gt;Lupa password?&lt;/a&gt;
            @@endif
            &lt;x-primary-button class="ms-3"&gt;Masuk&lt;/x-primary-button&gt;
        &lt;/div&gt;

        &lt;div class="text-center mt-4"&gt;
            &lt;a href="@{{ route('register') }}" class="text-sm text-gray-600 underline"&gt;
                Belum punya akun? Daftar di sini
            &lt;/a&gt;
        &lt;/div&gt;
    &lt;/form&gt;
&lt;/x-guest-layout&gt;</div>

    <h2>8.3 Dashboard Admin</h2>
    <p>File: <code class="code-inline">resources/views/admin/dashboard.blade.php</code></p>

    <div class="code-block"><div class="code-title">resources/views/admin/dashboard.blade.php (struktur)</div>&lt;x-app-layout&gt;
    &lt;x-slot name="header"&gt;
        &lt;h2 class="font-semibold text-xl text-gray-800"&gt;Dashboard Admin&lt;/h2&gt;
    &lt;/x-slot&gt;

    &lt;div class="py-8"&gt;
        &lt;div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"&gt;

            {{-- Kartu Statistik --}}
            &lt;div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8"&gt;
                &lt;div class="bg-white rounded-xl shadow p-5"&gt;
                    &lt;p class="text-gray-500 text-sm"&gt;Total Buku&lt;/p&gt;
                    &lt;p class="text-3xl font-bold text-blue-600"&gt;@{{ $totalBuku }}&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class="bg-white rounded-xl shadow p-5"&gt;
                    &lt;p class="text-gray-500 text-sm"&gt;Pengguna&lt;/p&gt;
                    &lt;p class="text-3xl font-bold text-green-600"&gt;@{{ $totalPengguna }}&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class="bg-white rounded-xl shadow p-5"&gt;
                    &lt;p class="text-gray-500 text-sm"&gt;Sedang Dipinjam&lt;/p&gt;
                    &lt;p class="text-3xl font-bold text-yellow-600"&gt;@{{ $totalDipinjam }}&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class="bg-white rounded-xl shadow p-5"&gt;
                    &lt;p class="text-gray-500 text-sm"&gt;Terlambat&lt;/p&gt;
                    &lt;p class="text-3xl font-bold text-red-600"&gt;@{{ $totalTerlambat }}&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class="bg-white rounded-xl shadow p-5"&gt;
                    &lt;p class="text-gray-500 text-sm"&gt;Total Denda&lt;/p&gt;
                    &lt;p class="text-3xl font-bold text-orange-600"&gt;
                        Rp @{{ number_format($totalDenda, 0, ',', '.') }}
                    &lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;

            {{-- Tabel Peminjaman Terbaru --}}
            &lt;div class="bg-white rounded-xl shadow p-6"&gt;
                &lt;h3 class="font-semibold text-lg mb-4"&gt;Peminjaman Terbaru&lt;/h3&gt;
                &lt;table class="w-full text-sm"&gt;
                    &lt;thead class="bg-gray-50"&gt;
                        &lt;tr&gt;
                            &lt;th class="px-4 py-2 text-left"&gt;Pengguna&lt;/th&gt;
                            &lt;th class="px-4 py-2 text-left"&gt;Buku&lt;/th&gt;
                            &lt;th class="px-4 py-2 text-left"&gt;Status&lt;/th&gt;
                            &lt;th class="px-4 py-2 text-left"&gt;Tenggat&lt;/th&gt;
                        &lt;/tr&gt;
                    &lt;/thead&gt;
                    &lt;tbody&gt;
                        @@foreach($peminjamanterbaru as $p)
                        &lt;tr class="border-t"&gt;
                            &lt;td class="px-4 py-2"&gt;@{{ $p-&gt;user-&gt;name }}&lt;/td&gt;
                            &lt;td class="px-4 py-2"&gt;@{{ $p-&gt;book-&gt;judul }}&lt;/td&gt;
                            &lt;td class="px-4 py-2"&gt;@{{ $p-&gt;status }}&lt;/td&gt;
                            &lt;td class="px-4 py-2"&gt;@{{ $p-&gt;tenggat_waktu-&gt;format('d/m/Y') }}&lt;/td&gt;
                        &lt;/tr&gt;
                        @@endforeach
                    &lt;/tbody&gt;
                &lt;/table&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/x-app-layout&gt;</div>

    <div class="callout callout-info">
        <strong>📝 Catatan:</strong> View admin lainnya (CRUD buku, manajemen peminjaman, laporan) mengikuti pola yang sama. Semua view menggunakan komponen Blade dari Laravel Breeze (<code>&lt;x-app-layout&gt;</code>, <code>&lt;x-primary-button&gt;</code>, <code>&lt;x-input-label&gt;</code>, dll) dan Tailwind CSS untuk styling.
    </div>

    <h2>8.4 Daftar Semua File View</h2>

    <table class="doc-table">
        <thead>
            <tr><th>File</th><th>Fungsi</th></tr>
        </thead>
        <tbody>
            <tr><td>layouts/app.blade.php</td><td>Layout utama dengan navigasi</td></tr>
            <tr><td>layouts/guest.blade.php</td><td>Layout halaman login/register</td></tr>
            <tr><td>auth/login.blade.php</td><td>Form login</td></tr>
            <tr><td>auth/register.blade.php</td><td>Form registrasi</td></tr>
            <tr><td>admin/dashboard.blade.php</td><td>Dashboard statistik admin</td></tr>
            <tr><td>admin/books/index.blade.php</td><td>Daftar buku (admin)</td></tr>
            <tr><td>admin/books/create.blade.php</td><td>Form tambah buku</td></tr>
            <tr><td>admin/books/edit.blade.php</td><td>Form edit buku</td></tr>
            <tr><td>admin/books/show.blade.php</td><td>Detail buku + riwayat pinjam</td></tr>
            <tr><td>admin/borrowings/index.blade.php</td><td>Daftar peminjaman (admin)</td></tr>
            <tr><td>admin/borrowings/create.blade.php</td><td>Form tambah peminjaman manual</td></tr>
            <tr><td>admin/borrowings/show.blade.php</td><td>Detail peminjaman + aksi konfirmasi</td></tr>
            <tr><td>admin/borrowings/laporan.blade.php</td><td>Laporan peminjaman bulanan</td></tr>
            <tr><td>admin/borrowings/laporan-pdf.blade.php</td><td>Template PDF laporan</td></tr>
            <tr><td>user/dashboard.blade.php</td><td>Dashboard user</td></tr>
            <tr><td>user/books/index.blade.php</td><td>Katalog buku untuk user</td></tr>
            <tr><td>user/books/show.blade.php</td><td>Detail buku + form ajukan pinjam</td></tr>
            <tr><td>user/borrowings/riwayat.blade.php</td><td>Riwayat peminjaman user</td></tr>
            <tr><td>dokumentasi-pdf.blade.php</td><td>Template dokumentasi proyek (file ini)</td></tr>
        </tbody>
    </table>
</div>

<!-- ================================================================
     BAB 9: CARA MENJALANKAN
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 9</div>
        <h1>Cara Menjalankan Aplikasi</h1>
    </div>

    <h2>9.1 Langkah Setup Lengkap</h2>

    <div class="step-list">
        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-content">
                <strong>Clone / buat proyek dan masuk ke folder</strong>
                <div class="code-block" style="margin-top:4px;">cd web-perpustakaan</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-content">
                <strong>Install dependensi PHP</strong>
                <div class="code-block" style="margin-top:4px;">composer install</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-content">
                <strong>Salin .env dan generate key</strong>
                <div class="code-block" style="margin-top:4px;">cp .env.example .env
php artisan key:generate</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">4</div>
            <div class="step-content">
                <strong>Buat file database SQLite</strong>
                <div class="code-block" style="margin-top:4px;"># Linux/Mac:
touch database/database.sqlite

# Windows (PowerShell):
New-Item database\database.sqlite -ItemType File</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">5</div>
            <div class="step-content">
                <strong>Jalankan migrasi dan seeder</strong>
                <div class="code-block" style="margin-top:4px;">php artisan migrate
php artisan db:seed</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">6</div>
            <div class="step-content">
                <strong>Install dependensi Node.js dan build asset</strong>
                <div class="code-block" style="margin-top:4px;">npm install
npm run build</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">7</div>
            <div class="step-content">
                <strong>Buat symlink storage (untuk cover buku)</strong>
                <div class="code-block" style="margin-top:4px;">php artisan storage:link</div>
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">8</div>
            <div class="step-content">
                <strong>Jalankan server pengembangan</strong>
                <div class="code-block" style="margin-top:4px;">php artisan serve</div>
                <p>Buka browser: <strong>http://localhost:8000</strong></p>
            </div>
        </div>
    </div>

    <div class="callout callout-success">
        <strong>✅ Atau gunakan satu perintah:</strong><br>
        <code>composer run dev</code> — menjalankan artisan serve + npm run dev secara bersamaan (perlu konfigurasi di composer.json)
    </div>

    <h2>9.2 Akun Default (Dari Seeder)</h2>

    <table class="doc-table">
        <thead>
            <tr><th>Role</th><th>Email</th><th>Password</th><th>Akses</th></tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Admin</strong></td>
                <td>admin@perpus.com</td>
                <td>password123</td>
                <td>Dashboard admin, CRUD buku, manajemen peminjaman, laporan</td>
            </tr>
            <tr>
                <td><strong>User</strong></td>
                <td>user@perpus.com</td>
                <td>password123</td>
                <td>Lihat buku, ajukan pinjam, kembalikan buku, lihat riwayat</td>
            </tr>
        </tbody>
    </table>

    <h2>9.3 Ringkasan Perintah Artisan Berguna</h2>

    <table class="doc-table">
        <thead>
            <tr><th>Perintah</th><th>Fungsi</th></tr>
        </thead>
        <tbody>
            <tr><td><code>php artisan migrate:fresh --seed</code></td><td>Reset database + isi ulang data awal</td></tr>
            <tr><td><code>php artisan route:list</code></td><td>Lihat semua route yang terdaftar</td></tr>
            <tr><td><code>php artisan config:clear</code></td><td>Bersihkan cache konfigurasi</td></tr>
            <tr><td><code>php artisan view:clear</code></td><td>Bersihkan cache view yang ter-compile</td></tr>
            <tr><td><code>php artisan cache:clear</code></td><td>Bersihkan cache aplikasi</td></tr>
            <tr><td><code>php artisan tinker</code></td><td>Interaktif REPL untuk debug</td></tr>
            <tr><td><code>npm run dev</code></td><td>Mode pengembangan Vite (hot reload)</td></tr>
            <tr><td><code>npm run build</code></td><td>Build asset untuk produksi</td></tr>
        </tbody>
    </table>
</div>

<!-- ================================================================
     BAB 10: REFERENSI & PENUTUP
================================================================ -->
<div class="chapter">
    <div class="chapter-header">
        <div class="chapter-num">Bab 10</div>
        <h1>Referensi &amp; Penutup</h1>
    </div>

    <h2>10.1 Referensi Teknologi</h2>

    <table class="doc-table">
        <thead>
            <tr><th>Teknologi</th><th>Versi</th><th>Link Dokumentasi</th></tr>
        </thead>
        <tbody>
            <tr><td>Laravel</td><td>13.x</td><td>https://laravel.com/docs</td></tr>
            <tr><td>PHP</td><td>8.3+</td><td>https://www.php.net/docs.php</td></tr>
            <tr><td>Laravel Breeze</td><td>2.x</td><td>https://laravel.com/docs/starter-kits#breeze</td></tr>
            <tr><td>barryvdh/laravel-dompdf</td><td>3.x</td><td>https://github.com/barryvdh/laravel-dompdf</td></tr>
            <tr><td>Tailwind CSS</td><td>3.x</td><td>https://tailwindcss.com/docs</td></tr>
            <tr><td>Vite</td><td>5.x</td><td>https://vitejs.dev</td></tr>
            <tr><td>SQLite</td><td>3.x</td><td>https://www.sqlite.org/docs.html</td></tr>
        </tbody>
    </table>

    <h2>10.2 Struktur Status Peminjaman</h2>

    <table class="doc-table">
        <thead>
            <tr><th>Status</th><th>Deskripsi</th><th>Siapa yang set</th></tr>
        </thead>
        <tbody>
            <tr><td><span class="badge-status badge-yellow">menunggu_konfirmasi_pinjam</span></td><td>User sudah ajukan pinjam, menunggu admin</td><td>User</td></tr>
            <tr><td><span class="badge-status badge-blue">dipinjam</span></td><td>Admin sudah konfirmasi, buku sedang dipinjam</td><td>Admin</td></tr>
            <tr><td><span class="badge-status badge-red">terlambat</span></td><td>Melewati tenggat waktu belum dikembalikan</td><td>Sistem/Admin</td></tr>
            <tr><td><span class="badge-status badge-yellow">menunggu_konfirmasi_kembali</span></td><td>User sudah ajukan kembali, menunggu admin</td><td>User</td></tr>
            <tr><td><span class="badge-status badge-green">dikembalikan</span></td><td>Admin sudah konfirmasi pengembalian</td><td>Admin</td></tr>
        </tbody>
    </table>

    <h2>10.3 Aturan Bisnis Penting</h2>

    <ul>
        <li>Satu user maksimal meminjam <strong>3 buku</strong> secara bersamaan</li>
        <li>Tenggat waktu maksimal <strong>30 hari</strong> dari hari pengajuan</li>
        <li>Denda keterlambatan: <strong>Rp 1.000 per hari</strong></li>
        <li>Denda dihitung dari <strong>tanggal pengajuan kembali user</strong> (bukan tanggal konfirmasi admin), agar admin yang lambat konfirmasi tidak merugikan user</li>
        <li>Stok buku berkurang saat admin <strong>konfirmasi peminjaman</strong>, bukan saat user mengajukan</li>
        <li>Stok buku bertambah saat admin <strong>konfirmasi pengembalian</strong></li>
    </ul>

    <div class="section-divider"></div>

    <div class="callout callout-success">
        <strong>🎉 Selamat!</strong> Kamu sudah memiliki modul lengkap untuk membangun Aplikasi Web Perpustakaan dengan Laravel. Ikuti setiap bab secara berurutan, mulai dari instalasi hingga menjalankan aplikasi. Jika ada pertanyaan, rujuk ke dokumentasi resmi Laravel di <strong>https://laravel.com/docs</strong>.
    </div>

    <div class="highlight-box" style="margin-top:20px; text-align:center;">
        <strong>Dokumentasi ini di-generate otomatis oleh aplikasi</strong><br>
        <small>Dibuat pada: {{ now()->format('d F Y, H:i') }} WIB</small>
    </div>
</div>

</body>
</html>
