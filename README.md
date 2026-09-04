# App Perpustakaan

## Tujuan
Aplikasi manajemen perpustakaan sederhana menggunakan Laravel 12, sebagai bagian dari tugas Pertemuan 1: Framework, MVC & Setup Proyek.

## Cara Menjalankan Project Lokal
1. Clone repository ini
2. Jalankan `composer install`
3. Copy `.env.example` menjadi `.env`
4. Jalankan `php artisan key:generate`
5. Jalankan `php artisan serve`
6. Buka browser ke `http://localhost:8000`


## Pemahaman MVC

- **Model**: bagian yang mengurus data dan logika terkait database, seperti mengambil, menyimpan, atau mengubah data.
- **View**: bagian tampilan yang dilihat user, biasanya berupa file HTML/Blade yang menampilkan data ke browser.
- **Controller**: penghubung antara Model dan View — menerima request dari user, memproses lewat Model, lalu mengirim hasilnya ke View untuk ditampilkan.