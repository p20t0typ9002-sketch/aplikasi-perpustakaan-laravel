<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.books') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Buku</h2>
        </div>
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
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-xl shadow-blue-100/60 ring-1 ring-gray-100">
                <div class="md:flex md:min-h-[34rem]">
                    {{-- Cover --}}
                    <div data-cover-panel class="relative flex shrink-0 items-center justify-center overflow-hidden bg-slate-800 p-6 sm:p-10 md:w-[21rem] md:p-7 lg:w-[24rem]">
                        @if($book->cover)
                            <img data-cover-source src="{{ asset('storage/' . $book->cover) }}" alt="" aria-hidden="true"
                                 class="absolute inset-0 h-full w-full scale-125 object-cover blur-3xl opacity-60">
                            <div class="absolute inset-0 bg-slate-950/30"></div>
                            <div class="relative w-full max-w-[17rem] overflow-hidden rounded-lg bg-white shadow-2xl shadow-black/40 ring-4 ring-white/20">
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                     alt="Cover buku {{ $book->judul }}"
                                     class="aspect-[2/3] w-full object-cover transition duration-500 hover:scale-105">
                            </div>
                        @else
                            <div class="flex aspect-[2/3] w-full max-w-[17rem] items-center justify-center rounded-lg border border-white/20 bg-white/10 shadow-2xl shadow-black/30">
                                <svg class="h-16 w-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 p-6 sm:p-8">
                        @if($book->kategori)
                            <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">{{ $book->kategori }}</span>
                        @endif
                        <h1 class="mt-3 text-3xl font-bold leading-tight text-gray-900 sm:text-4xl">{{ $book->judul }}</h1>
                        <p class="mt-2 text-base text-gray-600">oleh <span class="font-semibold text-gray-800">{{ $book->penulis }}</span></p>

                        <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-gray-400">Penerbit</p>
                                <p class="text-gray-700 font-medium">{{ $book->penerbit }}</p>
                            </div>
                            @if($book->tahun_terbit)
                            <div>
                                <p class="text-gray-400">Tahun Terbit</p>
                                <p class="text-gray-700 font-medium">{{ $book->tahun_terbit }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-gray-400">Stok</p>
                                <p class="{{ $book->stok > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                    {{ $book->stok > 0 ? "Tersedia ({$book->stok} buku)" : 'Stok Habis' }}
                                </p>
                            </div>
                        </div>

                        {{-- Form Pinjam --}}
                        <div class="mt-6 border-t pt-4">
                            @if($sedangMeminjam)
                                <div class="bg-yellow-50 border border-yellow-200 rounded p-3 text-sm text-yellow-800">
                                    ℹ️ Kamu sedang meminjam buku ini. Kembalikan dulu untuk meminjam lagi.
                                </div>
                            @elseif($book->stok <= 0)
                                <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-600">
                                    Stok buku sedang habis. Coba lagi nanti.
                                </div>
                            @else
                                <h3 class="font-semibold text-gray-700 mb-3">Ajukan Peminjaman Buku</h3>
                                <form action="{{ route('user.pinjam') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Tenggat Pengembalian <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" name="tenggat_waktu"
                                               value="{{ old('tenggat_waktu', now()->addDays(7)->toDateString()) }}"
                                               min="{{ now()->addDay()->toDateString() }}"
                                               max="{{ now()->addDays(30)->toDateString() }}"
                                               class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('tenggat_waktu') border-red-400 @enderror">
                                        <p class="text-xs text-gray-400 mt-1">Pengajuan akan menunggu konfirmasi admin. Maksimal peminjaman 30 hari. Denda Rp 1.000/hari jika terlambat.</p>
                                        @error('tenggat_waktu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                                        📚 Pinjam Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if($book->cover)
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const panel = document.querySelector('[data-cover-panel]');
                const cover = panel?.querySelector('[data-cover-source]');

                const applyCoverColor = () => {
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d', { willReadFrequently: true });

                    if (! context) {
                        return;
                    }

                    canvas.width = 1;
                    canvas.height = 1;
                    context.drawImage(cover, 0, 0, 1, 1);

                    const [red, green, blue] = context.getImageData(0, 0, 1, 1).data;
                    panel.style.background = `linear-gradient(135deg, rgb(${red}, ${green}, ${blue}), rgb(${Math.max(red - 45, 0)}, ${Math.max(green - 45, 0)}, ${Math.max(blue - 45, 0)}))`;
                };

                if (cover.complete) {
                    applyCoverColor();
                } else {
                    cover.addEventListener('load', applyCoverColor, { once: true });
                }
            });
        </script>
    @endif
</x-app-layout>
