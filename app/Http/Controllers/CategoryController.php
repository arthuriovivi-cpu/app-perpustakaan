<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Data dummy kategori.
     */
    protected array $categories = [
        1 => ['id' => 1, 'nama' => 'Fiksi'],
        2 => ['id' => 2, 'nama' => 'Non-Fiksi'],
        3 => ['id' => 3, 'nama' => 'Sains'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categories;

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('categories.index')
            ->with('success', "Kategori '{$validated['nama']}' berhasil ditambahkan (dummy, belum ke database).");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categories[$id] ?? null;

        if (! $category) {
            abort(404, 'Kategori tidak ditemukan.');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        $validated = $request->validated();

        return redirect()->route('categories.index')
            ->with('success', "Kategori id {$id} berhasil diperbarui (dummy, belum ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('categories.index')
            ->with('success', "Kategori id {$id} berhasil dihapus (dummy, belum ke database).");
    }
}