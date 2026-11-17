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
use App\Models\Kategori;

// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/uji-error', function () {
        throw new RuntimeException('Pengujian konfigurasi APP_DEBUG');
    });

    // Pencarian buku
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


    // =========================
    // ROUTE ADMIN
    // =========================
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->middleware('can:akses dashboard admin')
                ->name('dashboard');

            Route::get('/pengguna', [AdminPenggunaController::class, 'index'])
                ->middleware('can:kelola data pengguna')
                ->name('pengguna');

            Route::patch('/pengguna/{user}/role', [
                AdminPenggunaController::class,
                'updateRole'
            ])->middleware('can:kelola role pengguna')
                ->name('pengguna.updateRole');

            Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
                ->middleware('can:kelola peminjaman')
                ->name('peminjaman');

            Route::get('/laporan', [AdminLaporanController::class, 'index'])
                ->middleware('can:lihat laporan perpustakaan')
                ->name('laporan');
        });


    // =========================
    // CRUD BUKU ADMIN
    // =========================
    Route::middleware([
        'role:admin',
        'can:kelola data buku'
    ])->group(function () {

        // Form tambah buku
        Route::get('/buku/create', function () {
            $kategoris = Kategori::all();

            return view('buku.form', compact('kategoris'));
        })->name('buku.form');

        // Simpan buku baru
        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');

        // Form ubah buku
        Route::get('/buku/{id}/ubah', [BukuController::class, 'ubah'])
            ->whereNumber('id')
            ->name('buku.form.ubah');

        // Proses ubah buku
        Route::put('/buku/{id}', [BukuController::class, 'update'])
            ->whereNumber('id')
            ->name('buku.update');

        // Hapus buku
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
            ->name('buku.hapus');
    });


    // =========================
    // ROUTE PETUGAS
    // =========================
    Route::middleware(['role:petugas'])
        ->prefix('petugas')
        ->name('petugas.')
        ->group(function () {

            Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
                ->middleware('can:akses dashboard petugas')
                ->name('dashboard');

            // Daftar buku
            Route::get('/buku', [BukuController::class, 'index'])
                ->middleware('can:lihat daftar buku')
                ->name('buku.index');

            // CRUD buku petugas
            Route::middleware(['can:kelola data buku'])->group(function () {

                // Form tambah buku
                Route::get('/buku/create', function () {
                    $kategoris = Kategori::all();

                    return view('buku.form', compact('kategoris'));
                })->name('buku.create');

                // Simpan buku
                Route::post('/buku', [BukuController::class, 'store'])
                    ->name('buku.store');

                // Form ubah buku
                Route::get('/buku/{id}/ubah', [BukuController::class, 'ubah'])
                    ->whereNumber('id')
                    ->name('buku.edit');

                // Update buku
                Route::put('/buku/{id}', [BukuController::class, 'update'])
                    ->whereNumber('id')
                    ->name('buku.update');

                // Hapus buku
                Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
                    ->name('buku.destroy');
            });

            Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])
                ->middleware('can:kelola peminjaman')
                ->name('peminjaman');

            Route::patch('/peminjaman/{peminjaman}/kembali', [
                AdminPeminjamanController::class,
                'pengembalian'
            ])->middleware('can:kelola pengembalian')
                ->name('peminjaman.kembali');

            Route::get('/laporan', [AdminLaporanController::class, 'index'])
                ->middleware('can:lihat laporan perpustakaan')
                ->name('laporan');
        });


    // =========================
    // DAFTAR DAN DETAIL BUKU
    // =========================
    Route::middleware([
        'role:admin|petugas|siswa',
        'can:lihat daftar buku'
    ])->group(function () {

        Route::get('/buku', [BukuController::class, 'index'])
            ->name('buku.index');

        Route::get('/buku/{id}', [BukuController::class, 'lihat'])
            ->whereNumber('id')
            ->name('lihat.buku');
    });


    // Detail peminjaman
    Route::get('/peminjaman/{id}', [
        SiswaPeminjamanController::class,
        'show'
    ])->name('peminjaman.show');


    // =========================
    // ROUTE SISWA
    // =========================
    Route::middleware(['role:siswa'])
        ->prefix('siswa')
        ->name('siswa.')
        ->group(function () {

            Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/riwayat-peminjaman', [
                SiswaPeminjamanController::class,
                'index'
            ])->middleware('can:lihat riwayat peminjaman sendiri')
                ->name('peminjaman.index');

            Route::post('/peminjaman/{buku}', [
                SiswaPeminjamanController::class,
                'store'
            ])->name('peminjaman.store');
        });


    // =========================
    // PROFIL
    // =========================
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware('can:lihat profil sendiri')
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->middleware('can:ubah profil sendiri')
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';