<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
{
    Kategori::factory()->create([
        'nama' => 'Trilogi',
    ]);

    Kategori::factory()->create([
        'nama' => 'Fantasi',
    ]);

    Kategori::factory()->create([
        'nama' => 'Fiksi',
    ]);
}
}