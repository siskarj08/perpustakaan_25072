<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaPeminjamanController;
use App\Http\Controllers\AdminPenggunaController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\BukuController;


// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/uji-error', function () {
        throw new RuntimeException('Pengujian konfigurasi APP_DEBUG');
    });

    // Pencarian buku (Pengujian SQL Injection)
    Route::get('/buku-cari', [BukuController::class, 'cari'])
        ->name('buku.cari');

    // Dashboard berdasarkan role
    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('petugas')) {
            return redirect()->route('petugas.dashboard');
        }

        if ($user->hasRole('siswa')) {
            return redirect()->route('siswa.dashboard');
        }

        abort(403, 'Role pengguna tidak ditemukan.');

    })->name('dashboard');

    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::view('/dashboard', 'admin.dashboard')
                ->name('dashboard');

            Route::get('/pengguna', [AdminPenggunaController::class, 'index'])
                ->name('pengguna');

            Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
                ->name('peminjaman');

            Route::patch('/pengguna/{user}/role', [
                AdminPenggunaController::class,
                'updateRole'
            ])->name('pengguna.updateRole');

            Route::get('/laporan', [AdminLaporanController::class, 'index'])
                ->name('laporan');
        });


    Route::middleware(['role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        // Daftar buku
        Route::get('/buku', [BukuController::class, 'index'])
            ->name('buku.index');

        // Form tambah buku
        Route::get('/buku/create', function () {
            $kategoris = \App\Models\Kategori::all();

            return view('buku.form', compact('kategoris'));
        })->name('buku.create');

        // Simpan buku
        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');

        // Form ubah buku
        Route::get('/buku/{id}/ubah', [BukuController::class, 'ubah'])
            ->whereNumber('id')
            ->name('buku.edit');

        // Proses ubah buku
        Route::put('/buku/{id}', [BukuController::class, 'update'])
            ->whereNumber('id')
            ->name('buku.update');

        // Hapus buku
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
            ->name('buku.destroy');

        Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
            ->name('peminjaman');

        Route::get('/laporan', [AdminLaporanController::class, 'index'])
            ->name('laporan');

        Route::patch('/peminjaman/{peminjaman}/kembali', [
            AdminPeminjamanController::class,
            'pengembalian'
        ])->name('peminjaman.kembali');
    });

    
    Route::middleware(['can:kelola-buku'])->group(function () {

        Route::get('/buku/create', function () {
            $kategoris = \App\Models\Kategori::all();

            return view('buku.form', compact('kategoris'));
        })->name('buku.create');

        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');

        Route::get('/buku/{id}/ubah', [BukuController::class, 'ubah'])
            ->whereNumber('id')
            ->name('buku.edit');

        Route::put('/buku/{id}', [BukuController::class, 'update'])
            ->whereNumber('id')
            ->name('buku.update');

        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
            ->name('buku.destroy');
    });

    Route::middleware(['role:admin|petugas|siswa'])->group(function () {


        Route::get('/buku', [BukuController::class, 'index'])
            ->name('buku.index');

        // Detail buku
        Route::get('/buku/{id}', [BukuController::class, 'lihat'])
            ->whereNumber('id')
            ->name('lihat.buku');

    });

    Route::get('/peminjaman/{id}', [
            SiswaPeminjamanController::class,
            'show'
        ])->name('peminjaman.show');

    Route::middleware(['role:siswa'])
        ->prefix('siswa')
        ->name('siswa.')
        ->group(function () {

            Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/riwayat-peminjaman', [
                SiswaPeminjamanController::class,
                'index'
            ])->name('peminjaman.index');

            // Proses peminjaman buku
            Route::post('/peminjaman/{buku}', [
                SiswaPeminjamanController::class,
                'store'
            ])->name('peminjaman.store');
        });

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';


