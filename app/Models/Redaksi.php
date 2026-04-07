<?php
// app/Models/Redaksi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redaksi extends Model
{
    protected $table = 'redaksi';
    protected $fillable = ['nama', 'jabatan', 'email', 'urutan'];
}