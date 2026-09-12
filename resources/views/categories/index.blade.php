<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
</head>
<body>
    <h1>Daftar Kategori</h1>

    @if (session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}">+ Tambah Kategori</a>

    <table border="1" cellpadding="8" style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['nama'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>