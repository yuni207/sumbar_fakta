<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'category',
        'title',
        'slug',
        'content',
        'author',
        'release_date',
        'image_url',
        'video_url',
        'type',
        'views'
    ];

    /**
     * Boot function untuk otomatis membuat slug dari judul
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    /**
     * Scope untuk mengambil berita terbaru
     */
    public function scopeLatestNews($query)
    {
        return $query->latest();
    }
}