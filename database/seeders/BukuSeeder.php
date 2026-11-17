<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::updateOrCreate(
            ['judul' => 'Bumi Manusia'],
            [
                'kategori_id' => Kategori::where('nama', 'Trilogi')->firstOrFail()->id,
                'penulis' => 'Pramoedya Ananta Toer',
                'tahun_terbit' => 1980,
            ]
        );

        Buku::updateOrCreate(
            ['judul' => 'Dikta dan Hukum'],
            [
                'kategori_id' => Kategori::where('nama', 'Fantasi')->firstOrFail()->id,
                'penulis' => 'Dhiaan Farah',
                'tahun_terbit' => 2022,
            ]
        );

        Buku::updateOrCreate(
            ['judul' => '3672 MDPL'],
            [
                'kategori_id' => Kategori::where('nama', 'Fiksi')->firstOrFail()->id,
                'penulis' => 'Nurwina Sari',
                'tahun_terbit' => 2022,
            ]
        );

        Buku::updateOrCreate(
            ['judul' => 'Aroma Karsa'],
            [
                'kategori_id' => Kategori::where('nama', 'Fiksi')->firstOrFail()->id,
                'penulis' => 'Dee Lestari',
                'tahun_terbit' => 2018,
            ]
        );

        Buku::updateOrCreate(
            ['judul' => 'SagaraS'],
            [
                'kategori_id' => Kategori::where('nama', 'Fiksi')->firstOrFail()->id,
                'penulis' => 'Tere Liye',
                'tahun_terbit' => 2019,
            ]
        );
    }
}
