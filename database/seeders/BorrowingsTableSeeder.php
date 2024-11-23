<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BorrowingsTableSeeder extends Seeder
{
    public function run()
    {
        Borrowing::create([
            'user_id' => 2,  // ID Siswa 1
            'book_id' => 1,  // ID Buku "Buku Pemrograman Laravel"
            'borrowed_at' => now(),
            'returned_at' => null,
        ]);

        Borrowing::create([
            'user_id' => 3,  // ID Siswa 2
            'book_id' => 2,  // ID Buku "Buku Pemrograman PHP"
            'borrowed_at' => now(),
            'returned_at' => null,
        ]);

        // Tambahkan data dummy peminjaman lainnya sesuai kebutuhan
    }
}
