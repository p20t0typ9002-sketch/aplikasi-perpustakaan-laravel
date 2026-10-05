<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman - {{ $namaBulan }} {{ $tahun }}</title>
    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            line-height: 1.5;
            background: #fff;
        }

        /* Header */
        .header {
            text-align: center;
            padding: 20px 0 15px;
            border-bottom: 3px solid #3b82f6;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1e3a5f;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .header .subtitle {
            font-size: 14px;
            color: #64748b;
            font-weight: 400;
        }

        .header .period {
            margin-top: 8px;
            font-size: 13px;
            color: #3b82f6;
            font-weight: 600;
        }

        /* Summary Cards Row */
        .summary-row {
            width: 100%;
            margin-bottom: 20px;
        }

        .summary-row table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-card {
            text-align: center;
            padding: 12px 8px;
            border-radius: 6px;
            width: 25%;
        }

        .summary-card .number {
            font-size: 22px;
            font-weight: 700;
            display: block;
            margin-bottom: 2px;
        }

        .summary-card .label {
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-total {
            background: #eff6ff;
        }
        .card-total .number { color: #2563eb; }
        .card-total .label  { color: #3b82f6; }

        .card-returned {
            background: #f0fdf4;
        }
        .card-returned .number { color: #16a34a; }
        .card-returned .label  { color: #22c55e; }

        .card-late {
            background: #fef2f2;
        }
        .card-late .number { color: #dc2626; }
        .card-late .label  { color: #ef4444; }

        .card-fine {
            background: #fff7ed;
        }
        .card-fine .number { color: #ea580c; }
        .card-fine .label  { color: #f97316; }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .data-table thead th {
            background: #1e3a5f;
            color: #ffffff;
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table thead th:first-child {
            border-radius: 6px 0 0 0;
        }

        .data-table thead th:last-child {
            border-radius: 0 6px 0 0;
        }

        .data-table tbody td {
            padding: 8px 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 10.5px;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .badge-dipinjam {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-dikembalikan {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-terlambat {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-menunggu {
            background: #e0e7ff;
            color: #3730a3;
        }

        /* Denda styling */
        .denda-ada {
            color: #dc2626;
            font-weight: 600;
        }

        .denda-nol {
            color: #94a3b8;
        }

        /* Footer row */
        .data-table tfoot td {
            padding: 10px 8px;
            background: #f1f5f9;
            font-weight: 700;
            font-size: 11px;
            border-top: 2px solid #cbd5e1;
        }

        /* No data message */
        .no-data {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* Footer */
        .footer {
            margin-top: 25px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }

        .footer .generated {
            margin-bottom: 3px;
        }

        /* No. column */
        .col-no {
            width: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>📚 Perpustakaan</h1>
        <div class="subtitle">Laporan Peminjaman Buku</div>
        <div class="period">Periode: {{ $namaBulan }} {{ $tahun }}</div>
    </div>

    {{-- Summary Cards --}}
    <div class="summary-row">
        <table>
            <tr>
                <td class="summary-card card-total">
                    <span class="number">{{ $totalPeminjaman }}</span>
                    <span class="label">Total Peminjaman</span>
                </td>
                <td class="summary-card card-returned">
                    <span class="number">{{ $totalDikembalikan }}</span>
                    <span class="label">Dikembalikan</span>
                </td>
                <td class="summary-card card-late">
                    <span class="number">{{ $totalTerlambat }}</span>
                    <span class="label">Terlambat / Denda</span>
                </td>
                <td class="summary-card card-fine">
                    <span class="number">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                    <span class="label">Total Denda</span>
                </td>
            </tr>
        </table>
    </div>

    {{-- Detail Table --}}
    @if($data->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th>Pengguna</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tenggat</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $b)
                <tr>
                    <td class="col-no">{{ $i + 1 }}</td>
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->book->judul }}</td>
                    <td>{{ $b->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $b->tenggat_waktu->format('d/m/Y') }}</td>
                    <td>{{ $b->tanggal_kembali ? $b->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                    <td>
                        @if($b->status === 'dipinjam')
                            <span class="badge badge-dipinjam">Dipinjam</span>
                        @elseif($b->status === 'dikembalikan')
                            <span class="badge badge-dikembalikan">Dikembalikan</span>
                        @elseif($b->status === 'terlambat')
                            <span class="badge badge-terlambat">Terlambat</span>
                        @elseif(str_contains($b->status, 'menunggu'))
                            <span class="badge badge-menunggu">{{ ucfirst(str_replace('_', ' ', $b->status)) }}</span>
                        @else
                            <span class="badge">{{ ucfirst($b->status) }}</span>
                        @endif
                    </td>
                    <td class="{{ $b->denda > 0 ? 'denda-ada' : 'denda-nol' }}">
                        {{ $b->denda > 0 ? 'Rp ' . number_format($b->denda, 0, ',', '.') : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align: right;">Total Denda:</td>
                    <td class="denda-ada">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <div class="no-data">
            Tidak ada data peminjaman untuk bulan {{ $namaBulan }} {{ $tahun }}.
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <div class="generated">Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</div>
        <div>&copy; {{ date('Y') }} Perpustakaan &middot; Laporan ini digenerate secara otomatis</div>
    </div>

</body>
</html>
