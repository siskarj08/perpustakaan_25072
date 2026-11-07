<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::factory()->create([
            'kategori_id' => Kategori::where('nama', 'Trilogi')->first()->id,
            'judul' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'tahun_terbit' => 1980,
        ]);

        Buku::factory()->create([
            'kategori_id' => Kategori::where('nama', 'Fantasi')->first()->id,
            'judul' => 'Dikta dan Hukum',
            'penulis' => 'Dhiaan Farah',
            'tahun_terbit' => 2022,
        ]);

        Buku::factory()->create([
            'kategori_id' => Kategori::where('nama', 'Fiksi')->first()->id,
            'judul' => '3672 MDPL',
            'penulis' => 'Nurwina Sari',
            'tahun_terbit' => 2022,
        ]);

        Buku::factory()->create([
            'kategori_id' => Kategori::where('nama', 'Fiksi')->first()->id,
            'judul' => 'Aroma Karsa',
            'penulis' => 'Dee Lestari',
            'tahun_terbit' => 2018,
        ]);

        Buku::factory()->create([
            'kategori_id' => Kategori::where('nama', 'Fiksi')->first()->id,
            'judul' => 'SagaraS',
            'penulis' => 'Tere Liye',
            'tahun_terbit' => 2019,
        ]);
    }
}

