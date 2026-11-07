<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data
        $totalBuku = Buku::count();

        $totalPengguna = User::count();

        $totalPeminjaman = Peminjaman::count();

        // Menghitung status peminjaman
        $sedangDipinjam = Peminjaman::whereNull('tanggal_kembali')->count();

        $sudahDikembalikan = Peminjaman::whereNotNull('tanggal_kembali')->count();

        // Mengambil 10 transaksi terbaru
        $laporan = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('admin.laporan', compact(
            'totalBuku',
            'totalPengguna',
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahDikembalikan',
            'laporan'
        ));
    }
}