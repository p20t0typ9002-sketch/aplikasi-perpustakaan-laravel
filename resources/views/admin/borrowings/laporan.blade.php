<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter Bulan & Tahun --}}
            <div class="bg-white rounded-lg shadow p-4">
                <form method="GET" action="{{ route('admin.laporan') }}" class="flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Bulan</label>
                        <select name="bulan" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create(null, $m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Tahun</label>
                        <select name="tahun" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            @foreach(range(now()->year, now()->year - 5, -1) as $y)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Tampilkan</button>
                    <a href="{{ route('admin.laporan.export-pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                       class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition flex items-center gap-1.5 no-underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export PDF
                    </a>
                </form>
            </div>

            {{-- Statistik Ringkasan --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow p-5 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $totalPeminjaman }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Peminjaman</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5 text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $totalDikembalikan }}</p>
                    <p class="text-sm text-gray-500 mt-1">Dikembalikan</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5 text-center">
                    <p class="text-2xl font-bold text-red-600">{{ $totalTerlambat }}</p>
                    <p class="text-sm text-gray-500 mt-1">Terlambat / Kena Denda</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5 text-center">
                    <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Denda Bulan Ini</p>
                </div>
            </div>

            {{-- Tabel Detail --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h3 class="font-semibold text-gray-700">
                        Detail Peminjaman Bulan {{ \Carbon\Carbon::create(null, $bulan)->translatedFormat('F') }} {{ $tahun }}
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="text-left p-3 text-gray-600 font-medium">No</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Pengguna</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Buku</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Tgl Pinjam</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Tenggat</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Tgl Kembali</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Status</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Denda</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($data as $i => $b)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-500">{{ $i + 1 }}</td>
                                <td class="p-3 font-medium text-gray-800">{{ $b->user->name }}</td>
                                <td class="p-3 text-gray-700">{{ $b->book->judul }}</td>
                                <td class="p-3 text-gray-600">{{ $b->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="p-3 text-gray-600">{{ $b->tenggat_waktu->format('d/m/Y') }}</td>
                                <td class="p-3 text-gray-600">
                                    {{ $b->tanggal_kembali ? $b->tanggal_kembali->format('d/m/Y') : '-' }}
                                </td>
                                <td class="p-3">
                                    @if($b->status === 'dipinjam')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Dipinjam</span>
                                    @elseif($b->status === 'dikembalikan')
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Dikembalikan</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Terlambat</span>
                                    @endif
                                </td>
                                <td class="p-3 {{ $b->denda > 0 ? 'text-red-600 font-semibold' : 'text-gray-400' }}">
                                    {{ $b->denda > 0 ? 'Rp ' . number_format($b->denda, 0, ',', '.') : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center text-gray-400">Tidak ada data peminjaman bulan ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($data->count() > 0)
                        <tfoot class="bg-gray-50 border-t">
                            <tr>
                                <td colspan="7" class="p-3 text-right font-semibold text-gray-700">Total Denda:</td>
                                <td class="p-3 font-bold text-red-600">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
