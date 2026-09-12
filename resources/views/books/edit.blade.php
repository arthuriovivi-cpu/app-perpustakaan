<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>

    <form action="{{ route('books.update', $book['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul:</label><br>
        <input type="text" name="judul" value="{{ old('judul', $book['judul']) }}"><br>
        @error('judul')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" value="{{ old('penulis', $book['penulis']) }}"><br>
        @error('penulis')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ old('stok', $book['stok']) }}"><br>
        @error('stok')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Perbarui</button>
    </form>

    <br>
    <a href="{{ route('books.index') }}">← Kembali ke Daftar Buku</a>
</body>
</html>