<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Peminjaman</h2>
            <div class="flex gap-2">
                <form action="{{ route('admin.borrowings.tandai-terlambat') }}" method="POST">
                    @csrf
                    <button type="submit"
                            onclick="return confirm('Tandai semua peminjaman melewati tenggat sebagai terlambat?')"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Tandai Terlambat
                    </button>
                </form>
                <a href="{{ route('admin.borrowings.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    + Catat Peminjaman
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            {{-- Filter --}}
            <div class="bg-white rounded-lg shadow p-4">
                <form method="GET" action="{{ route('admin.borrowings.index') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama pengguna atau judul buku..."
                           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-48 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <select name="status" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="">Semua Status</option>
                        <option value="menunggu_konfirmasi_pinjam" {{ request('status') == 'menunggu_konfirmasi_pinjam' ? 'selected' : '' }}>Menunggu konfirmasi pinjam</option>
                        <option value="dipinjam"    {{ request('status') == 'dipinjam'    ? 'selected' : '' }}>Dipinjam</option>
                        <option value="menunggu_konfirmasi_kembali" {{ request('status') == 'menunggu_konfirmasi_kembali' ? 'selected' : '' }}>Menunggu konfirmasi kembali</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="terlambat"   {{ request('status') == 'terlambat'   ? 'selected' : '' }}>Terlambat</option>
                    </select>
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">Filter</button>
                    <a href="{{ route('admin.borrowings.index') }}" class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">Reset</a>
                </form>
            </div>

            {{-- Tabel --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
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
                                <th class="text-left p-3 text-gray-600 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($borrowings as $b)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-500">{{ $borrowings->firstItem() + $loop->index }}</td>
                                <td class="p-3">
                                    <p class="font-medium">{{ $b->user->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $b->user->email }}</p>
                                </td>
                                <td class="p-3 text-gray-700">{{ $b->book->judul }}</td>
                                <td class="p-3 text-gray-600">{{ $b->tanggal_pinjam?->format('d/m/Y') ?? 'Menunggu konfirmasi' }}</td>
                                <td class="p-3 {{ in_array($b->status, ['dipinjam', 'terlambat']) && $b->tenggat_waktu < now() ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                    {{ $b->tenggat_waktu->format('d/m/Y') }}
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ $b->tanggal_kembali ? $b->tanggal_kembali->format('d/m/Y') : '-' }}
                                </td>
                                <td class="p-3">
                                    @if($b->status === 'menunggu_konfirmasi_pinjam')
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Menunggu pinjam</span>
                                    @elseif($b->status === 'menunggu_konfirmasi_kembali')
                                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Menunggu kembali</span>
                                    @elseif($b->status === 'dipinjam')
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
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.borrowings.show', $b->id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs transition">Detail</a>

                                        @if($b->status === 'menunggu_konfirmasi_pinjam')
                                        <form action="{{ route('admin.borrowings.konfirmasi-pinjam', $b) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Konfirmasi peminjaman buku ini?')"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs transition">
                                                Konfirmasi Pinjam
                                            </button>
                                        </form>
                                        @elseif($b->status === 'menunggu_konfirmasi_kembali')
                                        <form action="{{ route('admin.borrowings.kembalikan', $b->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs transition">
                                                Kembalikan
                                            </button>
                                        </form>
                                        @endif

                                        <form action="{{ route('admin.borrowings.destroy', $b->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus data peminjaman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="p-6 text-center text-gray-400">Tidak ada data peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($borrowings->hasPages())
                    <div class="p-4 border-t">
                        {{ $borrowings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
