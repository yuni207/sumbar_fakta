<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings'; // sesuaikan dengan nama tabel Anda

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'title',
        'email',
        'tagline',
        'favicon',
        'logo',
        'iklan'
    ];
}
