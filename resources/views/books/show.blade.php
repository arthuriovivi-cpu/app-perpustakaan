<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
</head>
<body>
    <h1>Detail Buku</h1>

    <p><strong>ID:</strong> {{ $book['id'] }}</p>
    <p><strong>Judul:</strong> {{ $book['judul'] }}</p>
    <p><strong>Penulis:</strong> {{ $book['penulis'] }}</p>
    <p><strong>Stok:</strong> {{ $book['stok'] }}</p>

    <a href="{{ route('books.index') }}">← Kembali ke Daftar Buku</a>
</body>
</html>