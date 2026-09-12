<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Nama Kategori:</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}"><br>
        @error('nama')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('categories.index') }}">← Kembali ke Daftar Kategori</a>
</body>
</html>