<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('AdminBaru123'),
            ]
        );
        $admin->assignRole('admin');

        // 2. Akun Petugas
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('PetugasBaru123'),
            ]
        );
        $petugas->assignRole('petugas');

        // 3. Akun Mahasiswa
        $siswa = User::firstOrCreate(
            ['email' => 'siska@gmail.com'],
            [
                'name' => 'Siska',
                'password' => Hash::make('siska1234'),
            ]
        );
        $siswa->assignRole('siswa');

        $siswa = User::firstOrCreate(
            ['email' => 'ikoy@gmail.com'],
            [
                'name' => 'ikoyy',
                'password' => Hash::make('siska0809'),
            ]
        );
        $siswa->assignRole('siswa');
    }
}
