<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        Anggota::factory()->create([
            'id' => 1,
            'nama' => 'Siska',
            'email' => 'siska@gmail.com',
            'no_telepon' => '081234567890',
        ]);

        Anggota::factory()->create([
            'id' => 2,
            'nama' => 'Chiko',
            'email' => 'chiko@gmail.com',
            'no_telepon' => '081234567891',
        ]);

        Anggota::factory()->create([
            'id' => 3,
            'nama' => 'Piyo',
            'email' => 'piyo@gmail.com',
            'no_telepon' => '081234567892',
            ]);
    }
}