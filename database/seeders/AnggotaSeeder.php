<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        Anggota::updateOrCreate(
            ['email' => 'siska@gmail.com'],
            [
                'nama' => 'Siska',
                'no_telepon' => '081234567890',
            ]
        );

        Anggota::updateOrCreate(
            ['email' => 'ikoy@gmail.com'],
            [
                'nama' => 'Ikoyy',
                'no_telepon' => '081234567891',
            ]
        );
    }
}
