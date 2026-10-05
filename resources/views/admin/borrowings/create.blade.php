<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.borrowings.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catat Peminjaman Baru</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc ml-4 text-sm">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.borrowings.store') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        {{-- Pilih Pengguna --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pengguna <span class="text-red-500">*</span></label>
                            <select name="user_id" required
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('user_id') border-red-400 @enderror">
                                <option value="">-- Pilih Pengguna --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Pilih Buku --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Buku <span class="text-red-500">*</span></label>
                            <select name="book_id" required
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 @error('book_id') border-red-400 @enderror">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->judul }} (Stok: {{ $book->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Tanggal Pinjam & Tenggat --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', now()->toDateString()) }}"
                                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                       required>
                                @error('tanggal_pinjam')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tenggat Waktu <span class="text-red-500">*</span></label>
                                <input type="date" name="tenggat_waktu" value="{{ old('tenggat_waktu', now()->addDays(7)->toDateString()) }}"
                                       class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                       required>
                                @error('tenggat_waktu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                            Catat Peminjaman
                        </button>
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-lg text-sm font-medium transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
