@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>

    <h1>Tambah Kategori</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label for="nama_kategori">Nama Kategori</label><br>
        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"><br>
        @error('nama_kategori')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="deskripsi">Deskripsi (opsional)</label><br>
        <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi') }}</textarea><br>
        @error('deskripsi')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <br>
        <button type="submit" class="btn">Simpan</button>
    </form>
@endsection