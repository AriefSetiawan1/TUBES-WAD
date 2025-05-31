<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Konselor\JadwalController;
use App\Http\Controllers\Konselor\CatatanController;
use App\Http\Controllers\Mahasiswa\PemesananController;
use App\Http\Controllers\ArtikelPublikController;
use App\Http\Controllers\Konselor\ArtikelController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Mahasiswa only
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('mahasiswa.dashboard');

        // Tambah route lain khusus mahasiswa di sini

        // PemesananKonseling
        Route::get('/mahasiswa/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::post('/mahasiswa/pemesanan/{id}', [PemesananController::class, 'store'])->name('pemesanan.store');

        // Artikel
        Route::get('/artikel', [ArtikelPublikController::class, 'index'])->name('artikel.publik');
        Route::get('/artikel/{id}', [ArtikelPublikController::class, 'show'])->name('artikel.show');
    });

    // Konselor only
    Route::middleware(['role:konselor'])->group(function () {
        Route::get('/konselor/dashboard', function () {
            return view('konselor.dashboard');
        })->name('konselor.dashboard');

        // Tambah route lain khusus konselor di sini

        // Jadwal
        Route::resource('/konselor/jadwal', JadwalController::class)->names('jadwal');
        Route::get('/konselor/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/konselor/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('/konselor/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('/konselor/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('/konselor/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/konselor/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

        // Catatan
        Route::resource('/konselor/catatan', CatatanController::class)->names('catatan');
        Route::get('/konselor/catatan', [CatatanController::class, 'index'])->name('catatan.index');
        Route::get('/konselor/catatan/create', [CatatanController::class, 'create'])->name('catatan.create');
        Route::post('/konselor/catatan', [CatatanController::class, 'store'])->name('catatan.store');
        Route::get('/konselor/catatan/{id}/edit', [CatatanController::class, 'edit'])->name('catatan.edit');
        Route::put('/konselor/catatan/{id}', [CatatanController::class, 'update'])->name('catatan.update');
        Route::delete('/konselor/catatan/{id}', [CatatanController::class, 'destroy'])->name('catatan.destroy');

        // Artikel
        Route::resource('/konselor/artikel', ArtikelController::class)->names('artikel');
        Route::get('/konselor/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
        Route::get('/konselor/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
        Route::post('/konselor/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
        Route::get('/konselor/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('/konselor/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('/konselor/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
    });
});

require __DIR__.'/auth.php';
