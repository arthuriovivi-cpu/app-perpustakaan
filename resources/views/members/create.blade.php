<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Tambah Anggota Baru</h1>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}"><br>
        @error('nama')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label>No. HP:</label><br>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}"><br>
        @error('no_hp')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('members.index') }}">← Kembali ke Daftar Anggota</a>
</body>
</html>