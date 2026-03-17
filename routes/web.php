<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController; // Alias agar tidak bentrok
use App\Http\Controllers\Admin\PostController;
use App\Models\Setting;
use App\Models\News;
use App\Models\Post;

// --- HALAMAN DEPAN (PUBLIK) ---
Route::get('/', function () {
    $setting = Setting::first();
    $main_news = Post::orderBy('created_at', 'desc')->first();
    $running_news = Post::latest()->take(5)->get();
    $posts = Post::latest()->get();

    return view('frontend.index', compact('setting', 'main_news', 'running_news', 'posts'));
});

/** * PINDAHKAN KE SINI:
 * Agar pengunjung bisa mencari berita tanpa harus login admin
 * Sesuaikan Controller-nya, jika logic search ada di Admin\NewsController, panggil lengkap:
 */
Route::get('/search', [App\Http\Controllers\Admin\PostController::class, 'search'])->name('news.search');

Route::get('/news/{slug}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('news.show');

// --- AUTHENTICATION ---
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- GROUP RUTE ADMIN (BUTUH LOGIN) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Profile
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/change', [HomeController::class, 'change'])->name('change');
    Route::post('/change-password', [HomeController::class, 'change_password'])->name('changePassword');
    Route::get('/keluar', [HomeController::class, 'keluar'])->name('keluar');

    // Setting
    Route::prefix('setting')
        ->name('setting.')
        ->controller(SettingController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'create')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });

    // Posts
    Route::prefix('posts')
        ->name('posts.')
        ->controller(PostController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'create')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
});
