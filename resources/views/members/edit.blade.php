@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <h1>Edit Anggota</h1>

    <form action="{{ route('members.update', $member['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">Nama</label><br>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $member['nama']) }}"><br>
        @error('nama')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="nim">NIM</label><br>
        <input type="text" name="nim" id="nim" value="{{ old('nim', $member['nim']) }}"><br>
        @error('nim')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="{{ old('email', $member['email']) }}"><br>
        @error('email')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="nomor_telepon">Nomor Telepon</label><br>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $member['nomor_telepon']) }}"><br>
        @error('nomor_telepon')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="alamat">Alamat</label><br>
        <textarea name="alamat" id="alamat" rows="3">{{ old('alamat', $member['alamat']) }}</textarea><br>
        @error('alamat')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <label for="status">Status</label><br>
        <select name="status" id="status">
            <option value="aktif" @selected(old('status', $member['status']) == 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status', $member['status']) == 'nonaktif')>Nonaktif</option>
        </select><br>
        @error('status')
            <div style="color:#b91c1c; font-size:14px;">{{ $message }}</div>
        @enderror

        <br>
        <button type="submit" class="btn">Perbarui</button>
    </form>
@endsection