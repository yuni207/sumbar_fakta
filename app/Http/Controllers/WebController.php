<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $setting = \App\Models\Setting::first(); // Ambil dari database

        $data = [
            'favicon'      => asset('storage/' . $setting->favicon),
            'title'        => $setting->title,
            'hari_tanggal' => \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y'),
            'email'        => $setting->email,
            'logo'         => $setting->logo, // atau teks jika logo berbentuk string
            'tagline'      => $setting->tagline,
            'iklan'        => asset('storage/' . $setting->iklan)
        ];

        return view('welcome', compact('data'));
    }
}
