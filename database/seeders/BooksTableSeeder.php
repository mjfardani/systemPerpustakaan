<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'title' => 'Buku Pemrograman Laravel',
            'description' => 'Buku ini mengajarkan dasar-dasar Laravel untuk pemula.',
            'category_id' => 1,  // Pastikan kategori dengan ID 1 sudah ada
            'quantity' => 10,
        ]);

        Book::create([
            'title' => 'Buku Pemrograman PHP',
            'description' => 'Buku ini mengajarkan dasar-dasar PHP untuk pemula.',
            'category_id' => 1,  // Pastikan kategori dengan ID 1 sudah ada
            'quantity' => 5,
        ]);

        // Tambahkan data dummy buku lainnya sesuai kebutuhan
    }
}
