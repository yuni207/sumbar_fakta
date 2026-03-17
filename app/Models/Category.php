<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika nama tabel Anda 'categories')
    protected $table = 'categories';

    // Kolom yang boleh diisi
    protected $fillable = ['name', 'slug'];

    /**
     * Relasi ke Post
     * Satu kategori memiliki banyak berita
     */
    public function posts()
    {
        // Menambahkan 'category_id' secara eksplisit agar lebih aman
        return $this->hasMany(Post::class, 'category_id');
    }

    /**
     * Route Key Name
     * Agar saat mencari kategori di URL menggunakan slug, bukan ID
     * Contoh: sumbarfakta.com/category/politik
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}