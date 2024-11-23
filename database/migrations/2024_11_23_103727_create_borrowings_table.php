<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // ID pengguna (siswa) yang meminjam
            $table->unsignedBigInteger('book_id');  // ID buku yang dipinjam
            $table->dateTime('borrowed_at');  // Tanggal dan waktu peminjaman
            $table->dateTime('returned_at')->nullable();  // Tanggal dan waktu pengembalian, bisa kosong
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};
