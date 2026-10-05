<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Buku</h2>
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
                <form method="GET" action="{{ route('user.books') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari judul, penulis, kategori..."
                           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-48 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <select name="kategori" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Cari</button>
                    <a href="{{ route('user.books') }}" class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">Reset</a>
                </form>
            </div>

            {{-- Grid Buku --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @forelse($books as $book)
                <a href="{{ route('user.books.show', $book->id) }}"
                   class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden group">
                    {{-- Cover --}}
                    <div class="aspect-[2/3] bg-gray-100 overflow-hidden">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 alt="{{ $book->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200 p-3">
                                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    {{-- Info --}}
                    <div class="p-3">
                        <p class="text-sm font-medium text-gray-800 line-clamp-2 leading-tight">{{ $book->judul }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $book->penulis }}</p>
                        @if($book->kategori)
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs px-1.5 py-0.5 rounded mt-1">{{ $book->kategori }}</span>
                        @endif
                        <div class="mt-2">
                            @if($book->stok > 0)
                                <span class="text-green-600 text-xs font-medium">✓ Tersedia ({{ $book->stok }})</span>
                            @else
                                <span class="text-red-500 text-xs font-medium">✗ Stok Habis</span>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full py-16 text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-lg">Tidak ada buku ditemukan.</p>
                    <a href="{{ route('user.books') }}" class="text-blue-600 hover:underline text-sm mt-1 inline-block">Lihat semua buku</a>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($books->hasPages())
                <div>{{ $books->links() }}</div>
            @endif

        </div>
    </div>
</x-app-layout>
