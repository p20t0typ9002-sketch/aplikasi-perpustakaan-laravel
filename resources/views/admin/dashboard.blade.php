<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin Perpustakaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $totalBuku }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Buku</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $totalPengguna }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Pengguna</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-600">{{ $totalDipinjam }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sedang Dipinjam</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-red-600">{{ $totalTerlambat }}</p>
                    <p class="text-sm text-gray-500 mt-1">Terlambat</p>
                </div>
            </div>

            {{-- Total Denda --}}
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500 text-sm">Total Denda Terkumpul</p>
                <p class="text-2xl font-bold text-red-700 mt-1">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>
            </div>

            {{-- Peminjaman Terbaru --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">Peminjaman Terbaru</h3>
                    <a href="{{ route('admin.borrowings.index') }}" class="text-sm text-blue-600 hover:underline">Lihat semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left p-3 text-gray-600">Pengguna</th>
                                <th class="text-left p-3 text-gray-600">Buku</th>
                                <th class="text-left p-3 text-gray-600">Tgl Pinjam</th>
                                <th class="text-left p-3 text-gray-600">Tenggat</th>
                                <th class="text-left p-3 text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($peminjamanterbaru as $b)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">{{ $b->user->name }}</td>
                                <td class="p-3">{{ $b->book->judul }}</td>
                                <td class="p-3">{{ $b->tanggal_pinjam?->format('d/m/Y') ?? '-' }}</td>
                                <td class="p-3">{{ $b->tenggat_waktu?->format('d/m/Y') ?? '-' }}</td>
                                <td class="p-3">
                                    @if($b->status === 'dipinjam')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Dipinjam</span>
                                    @elseif($b->status === 'dikembalikan')
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Dikembalikan</span>
                                    @elseif($b->status === 'terlambat')
                                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Terlambat</span>
                                    @elseif($b->status === 'menunggu_konfirmasi_pinjam')
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Menunggu Konfirmasi</span>
                                    @elseif($b->status === 'menunggu_konfirmasi_kembali')
                                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Menunggu Konfirmasi Kembali</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ $b->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-400">Belum ada peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Shortcut --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.books.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Buku
                </a>
                <a href="{{ route('admin.borrowings.create') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-4 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Catat Peminjaman
                </a>
                <a href="{{ route('admin.borrowings.index', ['status' => 'dipinjam']) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-4 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Peminjaman Aktif
                </a>
                <a href="{{ route('admin.laporan') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-4 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0120 9.414V19a2 2 0 01-2 2z" /></svg>
                    Laporan
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
