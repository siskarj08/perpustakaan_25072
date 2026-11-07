<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class AdminPeminjamanController extends Controller
{
   public function index()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        $totalPeminjaman = Peminjaman::count();

        $sedangDipinjam = Peminjaman::whereNull('tanggal_kembali')->count();

        $sudahDikembalikan = Peminjaman::whereNotNull('tanggal_kembali')->count();

        return view('admin.peminjaman', compact(
            'peminjaman',
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahDikembalikan'
        ));
    }
}