# Skenario Demo - App Perpustakaan Digital Kampus

Persiapan sebelum demo:

1. MySQL (XAMPP) menyala.
2. Jalankan `php artisan migrate:fresh --seed` agar data bersih dan konsisten.
3. Nyalakan dua server di dua terminal: `php artisan serve --port=8000` dan `php artisan serve --port=8011`.
4. Buka `http://127.0.0.1:8000` di browser.

## Urutan Demo

### 1. Login
- Buka `/login`, masuk sebagai admin: `admin@pens.ac.id` / `password`.
- Tunjukkan bahwa login yang salah menampilkan pesan "Email atau password salah."
- Setelah login berhasil, aplikasi langsung menampilkan Dashboard, dan nama beserta role tampil di navbar.

### 2. Dashboard
- Tunjukkan tiga kartu statistik: Total Buku, Total Anggota, Peminjaman Aktif.
- Jelaskan bahwa angka ini diambil dari `GET /api/stats`, bukan dari query langsung.

### 3. Tambah Kategori (khusus admin)
- Menu Kategori, klik Tambah Kategori, isi nama dan deskripsi, simpan.
- Tunjukkan kategori baru muncul di daftar.

### 4. Tambah Buku
- Menu Buku, klik Tambah Buku, isi semua kolom dan pilih kategori yang baru dibuat, simpan.
- Tunjukkan validasi: kirim form kosong dan tampilkan pesan error.

### 5. Tambah Anggota
- Menu Anggota, klik Tambah Anggota, isi data lengkap, simpan.

### 6. Buat Peminjaman
- Menu Peminjaman, klik Tambah Peminjaman.
- Pilih anggota, isi tanggal pinjam dan tanggal kembali, centang satu atau lebih buku, simpan.
- Tunjukkan bahwa petugas tercatat otomatis dari akun yang login.

### 7. Lihat Daftar Peminjaman Aktif
- Di daftar Peminjaman, tunjukkan transaksi baru berstatus "dipinjam".

### 8. Proses Pengembalian
- Buka Edit pada transaksi tersebut, ubah status menjadi "dikembalikan", simpan.
- Tunjukkan status berubah di daftar.

### 9. Tampilkan Laporan
- Buka menu Laporan.
- Jelaskan bahwa tabel ini diambil dari `GET /api/loans` lewat Laravel HTTP Client.

### 10. Demo API
- Alat yang dipakai: Postman (atau `curl.exe` di terminal).
- Jalankan, dengan header `Accept: application/json`:
  - `GET http://127.0.0.1:8000/api/books`
  - `GET http://127.0.0.1:8000/api/stats`
  - `POST http://127.0.0.1:8000/api/books` dengan body kosong `{}` untuk menunjukkan status 422.
- Contoh perintah curl:

  ```
  curl.exe -i -H "Accept: application/json" http://127.0.0.1:8000/api/stats
  ```

### 11. Hak akses petugas
- Logout, login sebagai petugas: `petugas1@pens.ac.id` / `password`.
- Tunjukkan menu Kategori tidak muncul, dan membuka `/categories` langsung menghasilkan 403 Forbidden.

### 12. Uji ketahanan (opsional)
- Matikan server port 8011, lalu refresh Dashboard dan Laporan.
- Tunjukkan halaman tetap tampil dengan data kosong, tidak error 500.