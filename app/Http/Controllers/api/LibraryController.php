<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    // Tambah Kategori (Hanya Admin)
    public function addCategory(Request $request)
    {
        if (Auth::user()->role !== 'ADMIN') {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }

        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Kategori berhasil ditambahkan.'], 201);
    }

    // Tambah Buku (Hanya Admin)
    public function addBook(Request $request)
    {
        if (Auth::user()->role !== 'ADMIN') {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Buku berhasil ditambahkan.'], 201);
    }

    // Pinjam Buku (Hanya Siswa)
    public function borrowBook(Request $request)
    {
        if (Auth::user()->role !== 'SISWA') {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($request->book_id);

        if ($book->quantity < 1) {
            return response()->json(['message' => 'Stok buku habis!'], 400);
        }

        DB::beginTransaction();

        try {
            // Kurangi stok buku
            $book->decrement('quantity');

            // Buat catatan peminjaman
            Borrowing::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
            ]);

            DB::commit();

            return response()->json(['message' => 'Buku berhasil dipinjam.'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan.'], 500);
        }
    }

    // Kembalikan Buku (Hanya Siswa)
    // public function returnBook(Request $request)
    // {
    //     if (Auth::user()->role !== 'SISWA') {
    //         return response()->json(['message' => 'Akses ditolak!'], 403);
    //     }

    //     $request->validate([
    //         'borrowing_id' => 'required|exists:borrowings,id',
    //     ]);

    //     $borrowing = Borrowing::where('id', $request->borrowing_id)
    //         ->where('user_id', Auth::id())
    //         ->whereNull('returned_at')
    //         ->first();

    //     if (!$borrowing) {
    //         return response()->json(['message' => 'Peminjaman tidak ditemukan atau sudah dikembalikan.'], 404);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Tandai pengembalian
    //         $borrowing->update(['returned_at' => now()]);

    //         // Tambah stok buku
    //         $borrowing->book->increment('quantity');

    //         DB::commit();

    //         return response()->json(['message' => 'Buku berhasil dikembalikan.'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['message' => 'Terjadi kesalahan.'], 500);
    //     }
    // }
    public function getBooks(Request $request)
    {
        // Ambil semua buku yang ada di tabel 'books'
        $books = Book::all();

        // Jika tidak ada buku
        if ($books->isEmpty()) {
            return response()->json(['message' => 'Tidak ada buku yang tersedia.'], 404);
        }

        // Kembalikan daftar buku dalam format JSON
        return response()->json(['books' => $books], 200);
    }
}
