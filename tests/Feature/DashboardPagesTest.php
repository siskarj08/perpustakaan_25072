<?php

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

it('shows borrowing history without creating a missing member record', function () {
    $siswa = User::factory()->create(['role' => 'siswa']);
    $siswa->assignRole('siswa');

    $this->actingAs($siswa)
        ->get(route('siswa.peminjaman.index'))
        ->assertOk()
        ->assertSee('Belum Ada Peminjaman');

    $this->assertDatabaseCount('anggotas', 0);
});

it('renders the petugas dashboard with a loan and its relationships', function () {
    $petugas = User::factory()->create(['role' => 'petugas']);
    $petugas->assignRole('petugas');

    $siswa = User::factory()->create(['role' => 'siswa']);
    $anggota = Anggota::create([
        'user_id' => $siswa->id,
        'nama' => $siswa->name,
        'email' => $siswa->email,
    ]);
    $kategori = Kategori::factory()->create();
    $buku = Buku::create([
        'kategori_id' => $kategori->id,
        'judul' => 'Buku Pengujian',
        'penulis' => 'Penulis Pengujian',
        'tahun_terbit' => 2026,
    ]);
    Peminjaman::create([
        'anggota_id' => $anggota->id,
        'buku_id' => $buku->id,
        'tanggal_pinjam' => '2026-11-17',
        'tanggal_kembali' => null,
    ]);

    $this->actingAs($petugas)
        ->get(route('petugas.dashboard'))
        ->assertOk()
        ->assertViewHas('peminjamanTerbaru', function ($peminjamans) use ($anggota, $buku) {
            $peminjaman = $peminjamans->first();

            return $peminjaman !== null
                && $peminjaman->anggota->is($anggota)
                && $peminjaman->buku->is($buku);
        });
});
