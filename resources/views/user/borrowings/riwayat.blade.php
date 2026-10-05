<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            {{-- Tabel Riwayat --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">Semua Riwayat</h3>
                    <a href="{{ route('user.books') }}" class="text-sm text-blue-600 hover:underline">+ Pinjam Buku</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="text-left p-3 text-gray-600 font-medium">No</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Buku</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Waktu Pengajuan & Pinjam</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Tenggat</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Waktu Pengajuan & Kembali</th>
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
                                    <div class="flex gap-2 items-center">
                                        @if($b->book->cover)
                                            <img src="{{ asset('storage/' . $b->book->cover) }}" class="w-8 h-11 object-cover rounded flex-shrink-0" alt="cover">
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $b->book->judul }}</p>
                                            <p class="text-gray-400 text-xs">{{ $b->book->penulis }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-600">
                                    <p>Ajukan: {{ $b->tanggal_pengajuan_pinjam?->format('d/m/Y H:i') ?? '-' }}</p>
                                    <p class="text-xs text-green-700">Dikonfirmasi: {{ $b->tanggal_konfirmasi_pinjam?->format('d/m/Y H:i') ?? 'Menunggu admin' }}</p>
                                </td>
                                <td class="p-3 {{ in_array($b->status, ['dipinjam', 'terlambat']) && $b->tenggat_waktu < now() ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                    {{ $b->tenggat_waktu->format('d/m/Y') }}
                                </td>
                                <td class="p-3 text-gray-600">
                                    <p>Ajukan: {{ $b->tanggal_pengajuan_kembali?->format('d/m/Y H:i') ?? '-' }}</p>
                                    <p class="text-xs text-green-700">Dikonfirmasi: {{ $b->tanggal_konfirmasi_kembali?->format('d/m/Y H:i') ?? 'Menunggu admin' }}</p>
                                </td>
                                <td class="p-3">
                                    @if($b->status === 'menunggu_konfirmasi_pinjam')
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Menunggu konfirmasi pinjam</span>
                                    @elseif($b->status === 'menunggu_konfirmasi_kembali')
                                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Menunggu konfirmasi kembali</span>
                                    @elseif($b->status === 'dipinjam')
                                        @if($b->tenggat_waktu < now())
                                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">Terlambat!</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Dipinjam</span>
                                        @endif
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
                                    @if(in_array($b->status, ['dipinjam', 'terlambat']))
                                    <form action="{{ route('user.kembalikan', $b->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin mengembalikan buku ini?')"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition">
                                            Kembalikan
                                        </button>
                                    </form>
                                    @elseif($b->status === 'dikembalikan')
                                        <span class="text-gray-400 text-xs">Selesai</span>
                                    @else
                                        <span class="text-gray-400 text-xs">Menunggu admin</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p>Belum ada riwayat peminjaman.</p>
                                    <a href="{{ route('user.books') }}" class="text-blue-600 hover:underline text-sm mt-1 inline-block">Mulai pinjam buku →</a>
                                </td>
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
