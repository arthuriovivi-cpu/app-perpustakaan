<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
</head>
<body>
    <h1>Daftar Anggota</h1>

    @if (session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('members.create') }}">+ Tambah Anggota</a>

    <table border="1" cellpadding="8" style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. HP</th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member['id'] }}</td>
                <td>{{ $member['nama'] }}</td>
                <td>{{ $member['email'] }}</td>
                <td>{{ $member['no_hp'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>