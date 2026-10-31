# App Perpustakaan Digital Kampus

Aplikasi perpustakaan berbasis Laravel 12 untuk mata kuliah Workshop Pemrograman Framework. Fitur utama: autentikasi (admin dan petugas), CRUD buku, kategori, anggota, dan peminjaman, REST API, serta dashboard dan laporan yang mengonsumsi API sendiri.

## Kebutuhan

- PHP 8.2 atau lebih baru
- Composer
- MySQL (XAMPP)
- Git

## Cara Instalasi

1. Clone repository dan masuk ke foldernya:

   ```bash
   git clone https://github.com/arthuriovivi-cpu/app-perpustakaan.git
   cd app-perpustakaan
   ```

2. Install dependency:

   ```bash
   composer install
   ```

3. Salin file environment lalu buat application key:

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. Buat database kosong bernama `db_perpustakaan` di phpMyAdmin (collation `utf8mb4_unicode_ci`).

5. Atur file `.env`. Pastikan nilai berikut sesuai:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_perpustakaan
   DB_USERNAME=root
   DB_PASSWORD=

   SESSION_DRIVER=file
   CACHE_STORE=file

   APP_FAKER_LOCALE=id_ID
   INTERNAL_API_URL=http://127.0.0.1:8011
   ```

   `INTERNAL_API_URL` adalah alamat server kedua yang dipakai Dashboard dan Laporan untuk memanggil API internal. Port harus berbeda dari server utama.

6. Jalankan migrasi dan isi data dummy:

   ```bash
   php artisan migrate:fresh --seed
   ```

   Perintah ini menghapus seluruh isi database lalu mengisinya dengan 3 akun, 5 kategori, 20 buku, 15 anggota, dan 10 peminjaman.

## Cara Menjalankan (WAJIB dua server)

`php artisan serve` hanya memproses satu request pada satu waktu. Dashboard dan Laporan memanggil `/api/...` lewat HTTP dari dalam aplikasi sendiri, sehingga butuh server kedua agar tidak terjadi deadlock. Buka dua terminal:

Terminal 1 (server utama, dibuka di browser):

```bash
php artisan serve --port=8000
```

Terminal 2 (server khusus API internal):

```bash
php artisan serve --port=8011
```

Lalu buka `http://127.0.0.1:8000`. Jika server kedua tidak menyala, Dashboard dan Laporan tetap tampil tetapi datanya kosong.

## Akun Demo

Semua akun berpassword `password`.

| Nama | Email | Role |
|------|-------|------|
| Bambang Sutrisno | admin@pens.ac.id | admin |
| Siti Rahmawati | petugas1@pens.ac.id | petugas |
| Ahmad Fauzi | petugas2@pens.ac.id | petugas |

Menu Kategori hanya muncul dan hanya bisa diakses oleh admin. Petugas yang membuka `/categories` mendapat 403 Forbidden.

## REST API

Endpoint API bersifat publik (belum memakai autentikasi token). Dokumentasi lengkap beserta contoh response ada di [API.md](API.md).

## Struktur Singkat

- `app/Http/Controllers` : controller halaman web
- `app/Http/Controllers/Api` : controller REST API
- `app/Http/Resources` : API Resource (format JSON)
- `app/Http/Middleware/CheckAdminRole.php` : pembatas akses admin
- `database/seeders` dan `database/factories` : data dummy
- `routes/web.php` dan `routes/api.php` : daftar route