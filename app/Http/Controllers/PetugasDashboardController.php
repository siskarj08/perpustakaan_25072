<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalPengguna = User::count();
        $totalPeminjaman = Peminjaman::count();

        $sedangDipinjam = Peminjaman::whereNull('tanggal_kembali')->count();

        $sudahDikembalikan = Peminjaman::whereNotNull('tanggal_kembali')->count();

        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalPengguna',
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahDikembalikan',
            'peminjamanTerbaru'
        ));
    }
}