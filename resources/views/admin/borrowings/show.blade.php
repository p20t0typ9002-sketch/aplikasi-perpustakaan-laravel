<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.borrowings.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Peminjaman #{{ $borrowing->id }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Info Peminjaman --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-semibold text-gray-700">Informasi Peminjaman</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Pengguna</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->user->name }}</p>
                        <p class="text-gray-400 text-xs">{{ $borrowing->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Buku</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->book->judul }}</p>
                        <p class="text-gray-400 text-xs">{{ $borrowing->book->penulis }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tanggal Pinjam</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_pinjam?->format('d F Y') ?? 'Menunggu konfirmasi' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tenggat Waktu</p>
                        <p class="font-medium {{ $borrowing->status !== 'dikembalikan' && $borrowing->tenggat_waktu < now() ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $borrowing->tenggat_waktu->format('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tanggal Kembali</p>
                        <p class="font-medium text-gray-800">
                            {{ $borrowing->tanggal_kembali ? $borrowing->tanggal_kembali->format('d F Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Status</p>
                        @if($borrowing->status === 'menunggu_konfirmasi_pinjam')
                            <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium">Menunggu konfirmasi pinjam</span>
                        @elseif($borrowing->status === 'menunggu_konfirmasi_kembali')
                            <span class="bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full font-medium">Menunggu konfirmasi kembali</span>
                        @elseif($borrowing->status === 'dipinjam')
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-medium">Dipinjam</span>
                        @elseif($borrowing->status === 'dikembalikan')
                            <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-medium">Dikembalikan</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full font-medium">Terlambat</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-500">Denda</p>
                        <p class="font-semibold {{ $borrowing->denda > 0 ? 'text-red-600' : 'text-gray-500' }}">
                            {{ $borrowing->denda > 0 ? 'Rp ' . number_format($borrowing->denda, 0, ',', '.') : 'Tidak ada denda' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Pengajuan Pinjam</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_pengajuan_pinjam?->format('d F Y H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Konfirmasi Pinjam</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_konfirmasi_pinjam?->format('d F Y H:i') ?? 'Menunggu admin' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Pengajuan Kembali</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_pengajuan_kembali?->format('d F Y H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Konfirmasi Kembali</p>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_konfirmasi_kembali?->format('d F Y H:i') ?? 'Menunggu admin' }}</p>
                    </div>
                    @if($borrowing->status !== 'dikembalikan' && $borrowing->tenggat_waktu < now())
                    <div class="col-span-2 bg-red-50 rounded p-3 text-sm text-red-700">
                        ⚠️ Buku sudah melewati tenggat waktu.
                        Perkiraan denda saat ini:
                        <strong>Rp {{ number_format($borrowing->tenggat_waktu->diffInDays(now()) * 1000, 0, ',', '.') }}</strong>
                        ({{ $borrowing->tenggat_waktu->diffInDays(now()) }} hari × Rp 1.000)
                    </div>
                    @endif
                </div>
            </div>

            {{-- Aksi --}}
            @if($borrowing->status === 'menunggu_konfirmasi_pinjam')
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Konfirmasi Peminjaman</h3>
                <form action="{{ route('admin.borrowings.konfirmasi-pinjam', $borrowing) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                        Konfirmasi Peminjaman
                    </button>
                </form>
            </div>
            @elseif($borrowing->status === 'menunggu_konfirmasi_kembali')
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Konfirmasi Pengembalian</h3>
                <form action="{{ route('admin.borrowings.kembalikan', $borrowing->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                        <p class="font-medium text-gray-800">{{ $borrowing->tanggal_pengajuan_kembali?->format('d F Y H:i') }}</p>
                        <p class="text-xs text-gray-400 mt-1">Denda dihitung dari waktu pengajuan pengguna ini, bukan waktu konfirmasi admin.</p>
                    </div>
                    <button type="submit"
                            onclick="return confirm('Konfirmasi pengembalian buku ini? Denda akan dihitung otomatis.')"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                        ✓ Konfirmasi Pengembalian
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
