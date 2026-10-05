<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $books = $query->latest()->paginate(15);
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('admin.books.index', compact('books', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('admin.books.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.date('Y'),
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('cover');

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        $borrowings = $book->borrowings()->with('user')->latest()->paginate(10);

        return view('admin.books.show', compact('book', 'borrowings'));
    }

    public function edit(Book $book)
    {
        $kategoris = Book::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('admin.books.edit', compact('book', 'kategoris'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.date('Y'),
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('cover');

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        // Cek apakah ada peminjaman aktif
        $aktif = $book->borrowings()->whereIn('status', ['dipinjam', 'terlambat'])->count();
        if ($aktif > 0) {
            return back()->with('error', 'Buku tidak bisa dihapus karena masih ada yang meminjam.');
        }

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
