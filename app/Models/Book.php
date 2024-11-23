<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'quantity',
    ];

    // Relasi dengan kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan peminjaman
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
