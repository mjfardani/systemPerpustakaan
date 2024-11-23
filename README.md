# Library Management API

API ini digunakan untuk tugas akhir PAB
mengelola peminjaman buku, kategori buku, dan pengelolaan pengguna di sistem perpustakaan. API ini menggunakan **Laravel** dan **Sanctum** untuk autentikasi.

## Fitur

-   **Autentikasi Pengguna**: Admin dan siswa dapat login menggunakan token API.
-   **CRUD Kategori Buku**: Admin dapat menambah kategori buku.
-   **CRUD Buku**: Admin dapat menambah buku dan mengelola stok buku.
-   **Peminjaman Buku**: Siswa dapat meminjam buku.
-   **Menampilkan buku**: Siswa dapat melihat stok buku buku.

## Setup

### Persyaratan

-   PHP >= 8.0
-   Composer
-   Laravel >= 9.x
-   MySQL
-   Sanctum untuk autentikasi API

### Langkah-langkah Instalasi

1. **Clone Repositori**
    ```bash
    git clone https://github.com/mjfardani/systemPerpustakaan.git
    cd systemPerpustakaan
    ```
