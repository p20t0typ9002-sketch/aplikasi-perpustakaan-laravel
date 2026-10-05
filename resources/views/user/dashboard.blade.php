<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Halo, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            {{-- Statistik Singkat --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $activeBorrowings->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Buku Sedang Dipinjam</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ 3 - $activeBorrowings->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sisa Kuota Pinjam</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-3xl font-bold text-red-600">
                        {{ $activeBorrowings->where('status', 'terlambat')->count() + $activeBorrowings->filter(fn($b) => $b->tenggat_waktu < now())->count() }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">Terlambat Dikembalikan</p>
                </div>
            </div>

            {{-- Buku yang Sedang Dipinjam --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">Buku yang Sedang Dipinjam</h3>
                    <a href="{{ route('user.riwayat') }}" class="text-sm text-blue-600 hover:underline">Lihat Riwayat →</a>
                </div>

                @if($activeBorrowings->isEmpty())
                    <div class="p-8 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p>Kamu belum meminjam buku apapun.</p>
                        <a href="{{ route('user.books') }}" class="text-blue-600 hover:underline text-sm mt-1 inline-block">Cari buku →</a>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($activeBorrowings as $b)
                        <div class="p-4 flex items-start justify-between gap-4">
                            <div class="flex gap-4 items-start">
                                @if($b->book->cover)
                                    <img src="{{ asset('storage/' . $b->book->cover) }}" class="w-10 h-14 object-cover rounded shadow flex-shrink-0" alt="cover">
                                @else
                                    <div class="w-10 h-14 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs flex-shrink-0">N/A</div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-800">{{ $b->book->judul }}</p>
                                    <p class="text-gray-500 text-xs">{{ $b->book->penulis }}</p>
                                    <p class="text-xs mt-1 text-gray-500">
                                        Pinjam: {{ $b->tanggal_pinjam->format('d/m/Y') }}
                                        · Tenggat:
                                        <span class="{{ $b->tenggat_waktu < now() ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                            {{ $b->tenggat_waktu->format('d/m/Y') }}
                                        </span>
                                    </p>
                                    @if($b->tenggat_waktu < now())
                                        <p class="text-red-600 text-xs mt-1 font-semibold">
                                            ⚠️ Terlambat {{ $b->tenggat_waktu->diffInDays(now()) }} hari!
                                            Estimasi denda: Rp {{ number_format($b->tenggat_waktu->diffInDays(now()) * 1000, 0, ',', '.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('user.kembalikan', $b->id) }}" method="POST" class="flex-shrink-0">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin mengembalikan buku ini?')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded text-xs font-medium transition">
                                    Kembalikan
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Shortcut --}}
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('user.books') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-5 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="font-medium">Cari Buku</span>
                </a>
                <a href="{{ route('user.riwayat') }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-5 text-center transition">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium">Riwayat Peminjaman</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
