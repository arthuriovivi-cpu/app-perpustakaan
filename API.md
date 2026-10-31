# Dokumentasi REST API - App Perpustakaan

Base URL: `http://127.0.0.1:8000/api`

Semua request memakai header `Accept: application/json`. Request POST dan PUT yang membawa body juga memakai header `Content-Type: application/json`. Seluruh endpoint bersifat publik (belum ada autentikasi token). Response di bawah diambil langsung dari hasil request sungguhan ke aplikasi.

## Ringkasan Endpoint

| No | Method | URL | Body | Status Sukses | Status Gagal |
|----|--------|-----|------|---------------|--------------|
| 1 | GET | `/api/books` | - | 200 | - |
| 2 | GET | `/api/books/{id}` | - | 200 | 404 |
| 3 | POST | `/api/books` | JSON data buku | 201 | 422 |
| 4 | PUT | `/api/books/{id}` | JSON data buku | 200 | 404, 422 |
| 5 | DELETE | `/api/books/{id}` | - | 200 | 404 |
| 6 | GET | `/api/members` | - | 200 | - |
| 7 | GET | `/api/members/{id}` | - | 200 | 404 |
| 8 | GET | `/api/loans` | - | 200 | - |
| 9 | POST | `/api/loans` | JSON data peminjaman | 201 | 422 |
| 10 | PUT | `/api/loans/{id}/kembalikan` | - | 200 | 404 |
| 11 | GET | `/api/stats` | - | 200 | - |

## 1. GET /api/books

Mengambil daftar buku (10 per halaman). Filter opsional lewat query string: `?judul=` (pencarian sebagian) dan `?category_id=` (pencocokan persis).

Status sukses: `200 OK`

```json
{
    "data": [
        {
            "id": 2,
            "judul": "Laskar Pelangi",
            "penulis": "Andrea Hirata dwi",
            "penerbit": "iku dan temanku",
            "tahun_terbit": "2000",
            "isbn": "ini yang berubah",
            "stok": 50,
            "sampul": null,
            "category": {
                "id": 2,
                "nama_kategori": "dark fantasy supranatural"
            },
            "created_at": "2026-09-26T09:49:15.000000Z",
            "updated_at": "2026-09-27T15:07:19.000000Z"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/books?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http:\/\/127.0.0.1:8000\/api\/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http:\/\/127.0.0.1:8000\/api\/books",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

## 2. GET /api/books/{id}

Mengambil satu buku beserta kategorinya. Contoh: `GET /api/books/2`

Status sukses: `200 OK`

```json
{
    "data": {
        "id": 2,
        "judul": "Laskar Pelangi",
        "penulis": "Andrea Hirata dwi",
        "penerbit": "iku dan temanku",
        "tahun_terbit": "2000",
        "isbn": "ini yang berubah",
        "stok": 50,
        "sampul": null,
        "category": {
            "id": 2,
            "nama_kategori": "dark fantasy supranatural"
        },
        "created_at": "2026-09-26T09:49:15.000000Z",
        "updated_at": "2026-09-27T15:07:19.000000Z"
    }
}
```

Status gagal: `404 Not Found`. Contoh: `GET /api/books/999`

```json
{
    "message": "No query results for model [App\\Models\\Book] 999",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException"
}
```

Catatan: response aslinya juga memuat field `file`, `line`, dan `trace` (rincian debug). Field tersebut dipotong di dokumentasi ini karena panjang, dan hanya muncul saat `APP_DEBUG=true`.

## 3. POST /api/books

Menambah buku baru. Validasi memakai `StoreBookRequest`.

Body:

```json
{
    "judul": "Buku Uji API",
    "penulis": "Penulis Uji",
    "penerbit": "Penerbit Uji",
    "tahun_terbit": 2024,
    "isbn": "9786020000001",
    "stok": 5,
    "category_id": 2
}
```

Status sukses: `201 Created`

```json
{
    "data": {
        "id": 4,
        "judul": "Buku Uji API",
        "penulis": "Penulis Uji",
        "penerbit": "Penerbit Uji",
        "tahun_terbit": 2024,
        "isbn": "9786020000001",
        "stok": 5,
        "sampul": null,
        "category": {
            "id": 2,
            "nama_kategori": "dark fantasy supranatural"
        },
        "created_at": "2026-10-31T11:37:29.000000Z",
        "updated_at": "2026-10-31T11:37:29.000000Z"
    }
}
```

Status gagal: `422 Unprocessable Content`. Contoh: body kosong `{}`

```json
{
    "message": "Judul buku wajib diisi. (and 5 more errors)",
    "errors": {
        "judul": ["Judul buku wajib diisi."],
        "penulis": ["Nama penulis wajib diisi."],
        "penerbit": ["Nama penerbit wajib diisi."],
        "tahun_terbit": ["Tahun terbit wajib diisi."],
        "stok": ["Stok wajib diisi."],
        "category_id": ["The category id field is required."]
    }
}
```

## 4. PUT /api/books/{id}

Memperbarui data buku. Semua field wajib dikirim (kecuali `isbn`). Contoh: `PUT /api/books/4`

Body:

```json
{
    "judul": "Buku Uji API (Revisi)",
    "penulis": "Penulis Uji",
    "penerbit": "Penerbit Uji",
    "tahun_terbit": 2024,
    "isbn": "9786020000001",
    "stok": 10,
    "category_id": 2
}
```

Status sukses: `200 OK`

```json
{
    "data": {
        "id": 4,
        "judul": "Buku Uji API (Revisi)",
        "penulis": "Penulis Uji",
        "penerbit": "Penerbit Uji",
        "tahun_terbit": 2024,
        "isbn": "9786020000001",
        "stok": 10,
        "sampul": null,
        "category": {
            "id": 2,
            "nama_kategori": "dark fantasy supranatural"
        },
        "created_at": "2026-10-31T11:37:29.000000Z",
        "updated_at": "2026-10-31T11:41:03.000000Z"
    }
}
```

Status gagal: `404 Not Found` jika id tidak ada (format response sama seperti bagian 2), dan `422 Unprocessable Content` jika data tidak valid (format response sama seperti bagian 3).

## 5. DELETE /api/books/{id}

Menghapus buku. Contoh: `DELETE /api/books/4`

Status sukses: `200 OK`

```json
{
    "message": "Buku berhasil dihapus."
}
```

Status gagal: `404 Not Found` jika id tidak ada (format response sama seperti bagian 2).

## 6. GET /api/members

Mengambil daftar anggota (10 per halaman).

Status sukses: `200 OK`

```json
{
    "data": [
        {
            "id": 1,
            "nama": "oneal",
            "nim": "91847123",
            "email": "oneal@gmail.com",
            "nomor_telepon": "918324",
            "alamat": "ldfgewufyg",
            "status": "aktif",
            "created_at": "2026-09-26T09:49:51.000000Z",
            "updated_at": "2026-09-26T09:49:51.000000Z"
        },
        {
            "id": 2,
            "nama": "oci",
            "nim": "912837291873",
            "email": "inidiai@gmail.com",
            "nomor_telepon": "08129393719",
            "alamat": "surabaya",
            "status": "nonaktif",
            "created_at": "2026-09-27T15:23:09.000000Z",
            "updated_at": "2026-09-27T15:23:09.000000Z"
        },
        {
            "id": 3,
            "nama": "tedy",
            "nim": "092837912",
            "email": "iyah@gmail.com",
            "nomor_telepon": "2019381",
            "alamat": "Gresik",
            "status": "aktif",
            "created_at": "2026-09-27T15:23:35.000000Z",
            "updated_at": "2026-09-27T15:23:35.000000Z"
        },
        {
            "id": 4,
            "nama": "dhauril",
            "nim": "918237",
            "email": "tiwew@gmail.com",
            "nomor_telepon": "129837",
            "alamat": "bojonegero",
            "status": "nonaktif",
            "created_at": "2026-09-27T15:25:38.000000Z",
            "updated_at": "2026-09-27T15:25:38.000000Z"
        },
        {
            "id": 5,
            "nama": "towa",
            "nim": "812736",
            "email": "onl@gmail.com",
            "nomor_telepon": "9128321763",
            "alamat": "sidoar",
            "status": "aktif",
            "created_at": "2026-09-27T15:26:15.000000Z",
            "updated_at": "2026-09-27T15:26:15.000000Z"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/members?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/members?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http:\/\/127.0.0.1:8000\/api\/members?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http:\/\/127.0.0.1:8000\/api\/members",
        "per_page": 10,
        "to": 5,
        "total": 5
    }
}
```

## 7. GET /api/members/{id}

Mengambil satu anggota. Contoh: `GET /api/members/1`

Status sukses: `200 OK`

```json
{
    "data": {
        "id": 1,
        "nama": "oneal",
        "nim": "91847123",
        "email": "oneal@gmail.com",
        "nomor_telepon": "918324",
        "alamat": "ldfgewufyg",
        "status": "aktif",
        "created_at": "2026-09-26T09:49:51.000000Z",
        "updated_at": "2026-09-26T09:49:51.000000Z"
    }
}
```

Status gagal: `404 Not Found` jika id tidak ada (format response sama seperti bagian 2).

## 8. GET /api/loans

Mengambil daftar transaksi peminjaman beserta anggota, petugas, dan buku yang dipinjam (10 per halaman).

Status sukses: `200 OK`

```json
{
    "data": [
        {
            "id": 1,
            "member": {
                "id": 1,
                "nama": "oneal"
            },
            "petugas": {
                "id": 1,
                "name": "Admin Perpustakaan"
            },
            "tanggal_pinjam": "2026-10-06",
            "tanggal_kembali": "2026-10-29",
            "tanggal_dikembalikan": null,
            "status": "terlambat",
            "books": [
                {
                    "id": 2,
                    "judul": "Laskar Pelangi"
                }
            ]
        },
        {
            "id": 2,
            "member": {
                "id": 2,
                "nama": "oci"
            },
            "petugas": {
                "id": 3,
                "name": "Petugas Satu"
            },
            "tanggal_pinjam": "2026-10-23",
            "tanggal_kembali": "2026-10-30",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 2,
                    "judul": "Laskar Pelangi"
                }
            ]
        },
        {
            "id": 3,
            "member": {
                "id": 1,
                "nama": "oneal"
            },
            "petugas": {
                "id": 3,
                "name": "Petugas Satu"
            },
            "tanggal_pinjam": "2026-10-23",
            "tanggal_kembali": "2026-10-31",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 2,
                    "judul": "Laskar Pelangi"
                }
            ]
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/loans?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/loans?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http:\/\/127.0.0.1:8000\/api\/loans?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http:\/\/127.0.0.1:8000\/api\/loans",
        "per_page": 10,
        "to": 3,
        "total": 3
    }
}
```

## 9. POST /api/loans

Membuat transaksi peminjaman baru. `user_id` (petugas) wajib dikirim di body karena API belum memakai session login. Satu transaksi bisa memuat banyak buku lewat `book_ids`.

Body:

```json
{
    "member_id": 3,
    "user_id": 2,
    "tanggal_pinjam": "2026-10-31",
    "tanggal_kembali": "2026-11-07",
    "book_ids": [2]
}
```

Status sukses: `201 Created`

```json
{
    "data": {
        "id": 4,
        "member": {
            "id": 3,
            "nama": "tedy"
        },
        "petugas": {
            "id": 2,
            "name": "Admin Perpustakaan"
        },
        "tanggal_pinjam": "2026-10-31",
        "tanggal_kembali": "2026-11-07",
        "tanggal_dikembalikan": null,
        "status": "dipinjam",
        "books": [
            {
                "id": 2,
                "judul": "Laskar Pelangi"
            }
        ]
    }
}
```

Status gagal: `422 Unprocessable Content`. Contoh: body kosong `{}`

```json
{
    "message": "Anggota wajib dipilih. (and 4 more errors)",
    "errors": {
        "member_id": ["Anggota wajib dipilih."],
        "user_id": ["Petugas (user_id) wajib diisi."],
        "tanggal_pinjam": ["Tanggal pinjam wajib diisi."],
        "tanggal_kembali": ["Tanggal kembali wajib diisi."],
        "book_ids": ["Pilih minimal satu buku."]
    }
}
```

## 10. PUT /api/loans/{id}/kembalikan

Menandai peminjaman sebagai dikembalikan. `status` menjadi `dikembalikan` dan `tanggal_dikembalikan` diisi tanggal hari ini. Tidak membutuhkan body. Contoh: `PUT /api/loans/4/kembalikan`

Status sukses: `200 OK`

```json
{
    "data": {
        "id": 4,
        "member": {
            "id": 3,
            "nama": "tedy"
        },
        "petugas": {
            "id": 2,
            "name": "Admin Perpustakaan"
        },
        "tanggal_pinjam": "2026-10-31",
        "tanggal_kembali": "2026-11-07",
        "tanggal_dikembalikan": "2026-10-31",
        "status": "dikembalikan",
        "books": [
            {
                "id": 2,
                "judul": "Laskar Pelangi"
            }
        ]
    }
}
```

Status gagal: `404 Not Found` jika id tidak ada (format response sama seperti bagian 2).

## 11. GET /api/stats

Mengambil ringkasan statistik: jumlah buku, jumlah anggota, dan jumlah peminjaman yang berstatus `dipinjam`.

Status sukses: `200 OK`

```json
{
    "total_buku": 1,
    "total_anggota": 5,
    "peminjaman_aktif": 2
}
```