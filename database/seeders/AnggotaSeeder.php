<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $dataAnggota = [
            [
                'email' => 'siska@gmail.com',
                'nama' => 'Siska',
                'no_telepon' => '081234567890',
            ],
            [
                'email' => 'ikoy@gmail.com',
                'nama' => 'Ikoyy',
                'no_telepon' => '081234567891',
            ],
        ];

        foreach ($dataAnggota as $data) {
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                throw new \Exception(
                    'User ' . $data['email'] . ' tidak ditemukan.'
                );
            }

            // Cari anggota yang sudah terhubung dengan akun
            $anggota = Anggota::where('user_id', $user->id)->first();

            // Jika belum ada, cari data anggota lama yang belum terhubung
            if (!$anggota) {
                $anggota = Anggota::where('email', $data['email'])
                    ->whereNull('user_id')
                    ->first();
            }

            // Jika belum ditemukan, buat data baru
            if (!$anggota) {
                $anggota = new Anggota();
            }

            $anggota->user_id = $user->id;
            $anggota->nama = $data['nama'];
            $anggota->email = $data['email'];
            $anggota->no_telepon = $data['no_telepon'];
            $anggota->save();
        }
    }
}
