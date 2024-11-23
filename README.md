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

Clone Repositori

    git clone https://github.com/mjfardani/systemPerpustakaan.git
    cd systemPerpustakaan

Fitur

1. **Autentikasi Pengguna**

    - Admin dan siswa dapat login menggunakan email dan password, dan mendapatkan token API untuk autentikasi lebih lanjut.

2. **Pendaftaran Pengguna**

    - Admin dapat mendaftarkan pengguna baru, baik sebagai admin maupun siswa, melalui endpoint API yang disediakan.

3. **CRUD Kategori Buku**

    - Admin dapat menambah kategori buku dengan menggunakan API untuk mengelola koleksi buku di perpustakaan.

4. **CRUD Buku**

    - Admin dapat menambah buku baru ke dalam sistem perpustakaan dan mengelola stok buku (menambah jumlah buku yang tersedia).

5. **Peminjaman Buku**

    - Siswa dapat meminjam buku yang tersedia di perpustakaan. Sistem akan mencatat waktu peminjaman dan mengurangi stok buku yang dipinjam.

6. **Melihat Daftar Buku**
    - Siswa dapat melihat daftar buku yang tersedia untuk dipinjam.

## Penggunaan

### 1. **Login Admin atau Siswa**

-   Untuk mendapatkan token autentikasi, pengguna (baik admin atau siswa) perlu login terlebih dahulu menggunakan email dan password.
-   **Endpoint**: `/login`
-   **Metode**: `POST`
-   **Body**:
    ```json
    {
        "email": "admin@example.com",
        "password": "password"
    }
    ```
-   **Response**:
    ```json
    {
        "token": "token_string",
        "message": "Login successful"
    }
    ```

### 2. **Pendaftaran Admin**

-   Admin dapat mendaftarkan pengguna baru sebagai admin atau siswa melalui API.
-   **Endpoint**: `/user/register_admin`
-   **Metode**: `POST`
-   **Header**: `Authorization: Bearer <admin_token>`
-   **Body**:
    ```json
    {
        "name": "Admin Name",
        "email": "admin@example.com",
        "password": "password",
        "password_confirmation": "password"
    }
    ```
-   **Response**:
    ```json
    {
        "message": "Berhasil"
    }
    ```

### 3. **Menambah Buku**

-   Admin dapat menambahkan buku baru ke dalam sistem perpustakaan.
-   **Endpoint**: `/book`
-   **Metode**: `POST`
-   **Header**: `Authorization: Bearer <admin_token>`
-   **Body**:
    ```json
    {
        "title": "Book Title",
        "author": "Book Author",
        "quantity": 5,
        "category_id": 1
    }
    ```
-   **Response**:
    ```json
    {
        "message": "Buku berhasil ditambahkan"
    }
    ```

### 4. **Peminjaman Buku**

-   Siswa dapat meminjam buku yang tersedia di perpustakaan. Sistem akan mengurangi stok buku dan mencatat waktu peminjaman.
-   **Endpoint**: `/borrow`
-   **Metode**: `POST`
-   **Header**: `Authorization: Bearer <siswa_token>`
-   **Body**:
    ```json
    {
        "book_id": 1
    }
    ```
-   **Response**:
    ```json
    {
        "message": "Buku berhasil dipinjam"
    }
    ```

### 5. **Melihat Daftar Buku**

-   Siswa dapat melihat daftar buku yang tersedia di perpustakaan.
-   **Endpoint**: `/books`
-   **Metode**: `GET`
-   **Header**: `Authorization: Bearer <siswa_token>`
-   **Response**:
    ```json
    {
        "books": [
            {
                "id": 1,
                "title": "Book Title",
                "author": "Book Author",
                "quantity": 10
            },
            {
                "id": 2,
                "title": "Another Book",
                "author": "Another Author",
                "quantity": 5
            }
        ]
    }
    ```

### 6. **Logout**

-   Pengguna dapat melakukan logout untuk menghapus token yang digunakan.
-   **Endpoint**: `/logout`
-   **Metode**: `POST`
-   **Header**: `Authorization: Bearer <user_token>`
-   **Response**:
    ```json
    {
        "message": "Logged out successfully"
    }
    ```
