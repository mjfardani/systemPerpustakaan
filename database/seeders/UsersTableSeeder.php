<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@perpus.com',
            'password' => bcrypt('admin123'),  // Enkripsi password
            'role' => 'ADMIN',
            'plain_token' => '',
        ]);

        User::create([
            'name' => 'Siswa 1',
            'email' => 'siswa1@perpus.com',
            'password' => bcrypt('siswa123'),  // Enkripsi password
            'role' => 'SISWA',
            'plain_token' => '',
        ]);

        User::create([
            'name' => 'Siswa 2',
            'email' => 'siswa2@perpus.com',
            'password' => bcrypt('siswa123'),  // Enkripsi password
            'role' => 'SISWA',
            'plain_token' => '',
        ]);

        // Tambahkan data dummy pengguna lainnya sesuai kebutuhan
    }
}
