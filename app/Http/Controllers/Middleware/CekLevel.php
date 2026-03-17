<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar Auth dikenali dengan baik
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$levels
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Ambil level user (pastikan kolom 'level' ada di tabel users)
        $userLevel = Auth::user()->level;

        // 3. Cek apakah level user ada dalam daftar level yang diizinkan
        if (in_array($userLevel, $levels)) {
            return $next($request);
        }

        // 4. Jika tidak memiliki akses, arahkan kembali ke dashboard atau home dengan pesan error
        return redirect('/admin/home')->with('error', 'Anda tidak memiliki hak akses (' . $userLevel . ') untuk halaman tersebut.');
    }
}
