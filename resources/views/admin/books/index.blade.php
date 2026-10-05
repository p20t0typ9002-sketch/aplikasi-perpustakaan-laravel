<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Buku</h2>
            <a href="{{ route('admin.books.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filter & Pencarian --}}
            <div class="bg-white rounded-lg shadow p-4">
                <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari judul, penulis, kategori..."
                           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-48 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <select name="kategori" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">Cari</button>
                    <a href="{{ route('admin.books.index') }}" class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">Reset</a>
                </form>
            </div>

            {{-- Tabel Buku --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="text-left p-3 text-gray-600 font-medium">No</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Cover</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Judul / Penulis</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Penerbit</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Kategori</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Stok</th>
                                <th class="text-left p-3 text-gray-600 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-500">{{ $books->firstItem() + $loop->index }}</td>
                                <td class="p-3">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="cover" class="w-10 h-14 object-cover rounded shadow">
                                    @else
                                        <div class="w-10 h-14 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <p class="font-medium text-gray-800">{{ $book->judul }}</p>
                                    <p class="text-gray-500 text-xs">{{ $book->penulis }}</p>
                                </td>
                                <td class="p-3 text-gray-600">{{ $book->penerbit }}</td>
                                <td class="p-3">
                                    @if($book->kategori)
                                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $book->kategori }}</span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <span class="{{ $book->stok > 0 ? 'text-green-700 font-semibold' : 'text-red-600 font-semibold' }}">
                                        {{ $book->stok }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.books.edit', $book->id) }}"
                                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs transition">Edit</a>
                                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-400">
                                    Tidak ada buku ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($books->hasPages())
                    <div class="p-4 border-t">
                        {{ $books->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
