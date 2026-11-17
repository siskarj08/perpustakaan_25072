<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Peminjaman::updateOrCreate(
            [
                'anggota_id' => 1,
                'buku_id' => 1,
                'tanggal_pinjam' => '2026-09-20',
            ],
            [
                'tanggal_kembali' => '2026-09-23',
            ]
        );

        Peminjaman::updateOrCreate(
            [
                'anggota_id' => 2,
                'buku_id' => 3,
                'tanggal_pinjam' => '2026-09-22',
            ],
            [
                'tanggal_kembali' => null,
            ]
        );

        Peminjaman::updateOrCreate(
            [
                'anggota_id' => 3,
                'buku_id' => 4,
                'tanggal_pinjam' => '2026-09-25',
            ],
            [
                'tanggal_kembali' => '2026-09-28',
            ]
        );
    }
}
