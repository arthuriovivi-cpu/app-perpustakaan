<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>

    @if (session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('books.create') }}">+ Tambah Buku</a>

    <table border="1" cellpadding="8" style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book['id'] }}</td>
                <td>{{ $book['judul'] }}</td>
                <td>{{ $book['penulis'] }}</td>
                <td>{{ $book['stok'] }}</td>
                <td>
                    <a href="{{ route('books.show', $book['id']) }}">Detail</a> |
                    <a href="{{ route('books.edit', $book['id']) }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>