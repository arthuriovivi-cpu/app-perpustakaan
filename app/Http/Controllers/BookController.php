<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Data dummy buku. Ini BUKAN penyimpanan permanen —
     * setiap request baru, property ini dibuat ulang dari awal.
     */
    protected array $books = [
        1 => ['id' => 1, 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'stok' => 5],
        2 => ['id' => 2, 'judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'stok' => 3],
        3 => ['id' => 3, 'judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'stok' => 7],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->books;

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // $request sudah otomatis divalidasi oleh StoreBookRequest
        // sebelum baris ini dijalankan. Kalau validasi gagal,
        // Laravel otomatis redirect balik dengan pesan error.

        $validated = $request->validated();

        // Di sini seharusnya data disimpan ke database (Pertemuan 5).
        // Untuk sekarang, kita cuma tampilkan pesan sukses (dummy).

        return redirect()->route('books.index')
            ->with('success', "Buku '{$validated['judul']}' berhasil ditambahkan (dummy, belum ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->books[$id] ?? null;

        if (! $book) {
            abort(404, 'Buku tidak ditemukan.');
        }

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->books[$id] ?? null;

        if (! $book) {
            abort(404, 'Buku tidak ditemukan.');
        }

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $validated = $request->validated();

        return redirect()->route('books.index')
            ->with('success', "Buku id {$id} berhasil diperbarui (dummy, belum ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('books.index')
            ->with('success', "Buku id {$id} berhasil dihapus (dummy, belum ke database).");
    }
}