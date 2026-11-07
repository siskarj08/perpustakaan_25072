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

    // Dashboard berdasarkan role
    Route::get('/dashboard', function () {

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }

        return redirect()->route('siswa.dashboard');

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

            Route::resource('/buku', BukuController::class);

            Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
                ->name('peminjaman');

            Route::get('/laporan', [AdminLaporanController::class, 'index'])
                ->name('laporan');

            Route::patch('/peminjaman/{peminjaman}/kembali', [
                AdminPeminjamanController::class,
                'pengembalian'
            ])->name('peminjaman.kembali');
        });


    Route::middleware(['role:admin|petugas'])->group(function () {

        Route::middleware(['permission:tambah buku'])->group(function () {

            Route::get('/tambah', function () {
                return view('buku.form');
            })->name('buku.form');

            Route::get('/ubah/{id}', function ($id) {
                return view('buku.form', compact('id'));
            })->name('buku.form.ubah');

        });

    });

    Route::middleware(['role:admin|petugas|siswa'])->group(function () {

        // Daftar buku
        Route::get('/buku', function () {
            return view('buku.index');
        })->name('buku.index');

        // Detail buku
        Route::get('/buku/{id}', function ($id) {

            $databuku = \App\Models\Buku::with('kategori')->findOrFail($id);

            return view('buku.lihat', compact('databuku'));

        })->name('lihat.buku');

    });

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
