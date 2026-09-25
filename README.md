# App Perpustakaan

Aplikasi manajemen perpustakaan digital kampus, dibuat menggunakan Laravel 12. 
Aplikasi ini dikelola oleh admin/petugas untuk mengelola data buku, kategori, 
anggota, dan transaksi peminjaman buku.

## Tujuan

Project ini dibuat sebagai tugas mata kuliah Workshop Pemrograman Framework, 
untuk mempelajari konsep framework, arsitektur MVC, routing, validasi, 
hingga koneksi database menggunakan Laravel.

## Cara Menjalankan Project Secara Lokal

1. Clone repository ini
2. Jalankan `composer install`
3. Copy `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database
4. Jalankan `php artisan key:generate`
5. Jalankan `php artisan serve`
6. Buka `http://127.0.0.1:8000` di browser

## Pemahaman MVC

Menurut saya, 
Model: itu bagian yang mengurus data — misalnya data buku, anggota, atau peminjaman, termasuk aturan-aturan yang berkaitan dengan data tersebut. 
View: adalah bagian yang dilihat oleh pengguna, biasanya berupa halaman HTML, dll.
Controller: berperan sebagai penghubung antara Model dan View — dia menerima permintaan dari pengguna, mengambil atau mengubah data lewat Model, lalu mengirim data itu ke View supaya bisa ditampilkan ke pengguna.