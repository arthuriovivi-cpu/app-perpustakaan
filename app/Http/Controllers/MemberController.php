<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Data dummy anggota perpustakaan.
     */
    protected array $members = [
        1 => ['id' => 1, 'nama' => 'Budi Santoso', 'email' => 'budi@example.com', 'no_hp' => '081234567890'],
        2 => ['id' => 2, 'nama' => 'Siti Aminah', 'email' => 'siti@example.com', 'no_hp' => '081298765432'],
        3 => ['id' => 3, 'nama' => 'Andi Wijaya', 'email' => 'andi@example.com', 'no_hp' => '081345678901'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Anggota '{$validated['nama']}' berhasil ditambahkan (dummy, belum ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = $this->members[$id] ?? null;

        if (! $member) {
            abort(404, 'Anggota tidak ditemukan.');
        }

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = $this->members[$id] ?? null;

        if (! $member) {
            abort(404, 'Anggota tidak ditemukan.');
        }

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request, string $id)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Anggota id {$id} berhasil diperbarui (dummy, belum ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('members.index')
            ->with('success', "Anggota id {$id} berhasil dihapus (dummy, belum ke database).");
    }
}