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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama pengguna
            $table->string('email')->unique();  // Email pengguna
            $table->string('password');  // Kata sandi pengguna
            $table->enum('role', ['ADMIN', 'SISWA'])->default('SISWA');  // Role pengguna
            $table->timestamps();
            $table->string('plain_token');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 60)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
