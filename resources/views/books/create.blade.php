@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>

    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label for="judul">Judul</label><br>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"><br>
        @error('judul')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="penulis">Penulis</label><br>
        <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}"><br>
        @error('penulis')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="penerbit">Penerbit</label><br>
        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}"><br>
        @error('penerbit')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="tahun_terbit">Tahun Terbit</label><br>
        <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}"><br>
        @error('tahun_terbit')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="isbn">ISBN (opsional)</label><br>
        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}"><br>
        @error('isbn')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="stok">Stok</label><br>
        <input type="number" name="stok" id="stok" value="{{ old('stok', 1) }}"><br>
        @error('stok')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="category_id">Kategori</label><br>
        <select name="category_id" id="category_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" @selected(old('category_id') == $category['id'])>
                    {{ $category['nama_kategori'] }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <br><br>
        <button type="submit" class="btn">Simpan</button>
    </form>
@endsection