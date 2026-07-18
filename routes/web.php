<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

// 1. HALAMAN UTAMA PORTAL BERITA (KABAR BURUNG NEWS)
// Menampilkan portal berita malam hari saat pertama kali web dibuka di http://localhost:8000
Route::get('/', function () {
    $posts = Post::where('published', true)->orderBy('tanggal_kejadian', 'desc')->get();
    return view('index', compact('posts')); // Memanggil index.blade.php (kartu berita)
});

// 2. HALAMAN CRUD ADMIN (UNTUK KELOLA BERITA)
Route::resource('admin/posts', PostController::class);

// 3. RUTE DASHBOARD (YANG TADI KOSONGAN, KITA UBAH AGAR BISA BACA DATA BERITA)
Route::get('dashboard', function () {
    $posts = Post::orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('posts')); // Mengirim data berita ke dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// 4. RUTE PROFIL USER
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// 5. RUTE PENDUKUNG SISTEM AUTHENTICATION (LOGIN/REGISTER BREEZE)
require __DIR__.'/auth.php';

// Jembatan otomatis: Jika sistem mengarah ke /home, lempar langsung ke /dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth');