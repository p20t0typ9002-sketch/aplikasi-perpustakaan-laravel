<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Buku Baru</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        {{-- Judul --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul') }}"
                                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('judul') border-red-400 @enderror"
                                   required>
                            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Penulis --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penulis <span class="text-red-500">*</span></label>
                            <input type="text" name="penulis" value="{{ old('penulis') }}"
                                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('penulis') border-red-400 @enderror"
                                   required>
                            @error('penulis')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Penerbit --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit <span class="text-red-500">*</span></label>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}"
                                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('penerbit') border-red-400 @enderror"
                                   required>
                            @error('penerbit')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Kategori & Tahun --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input type="text" name="kategori" value="{{ old('kategori') }}"
                                       list="kategori-list"
                                       placeholder="Misal: Fiksi, Sains..."
                                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <datalist id="kategori-list">
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                       min="1000" max="{{ date('Y') }}"
                                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok', 1) }}" min="0"
                                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('stok') border-red-400 @enderror"
                                   required>
                            @error('stok')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Cover --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cover Buku</label>
                            <input type="file" name="cover" accept="image/*"
                                   class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP. Maks 2MB.</p>
                            @error('cover')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                            Simpan
                        </button>
                        <a href="{{ route('admin.books.index') }}"
                           class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-lg text-sm font-medium transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
