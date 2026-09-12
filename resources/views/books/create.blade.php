<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku Baru</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label>Judul:</label><br>
        <input type="text" name="judul" value="{{ old('judul') }}"><br>
        @error('judul')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" value="{{ old('penulis') }}"><br>
        @error('penulis')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ old('stok') }}"><br>
        @error('stok')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('books.index') }}">← Kembali ke Daftar Buku</a>
</body>
</html>