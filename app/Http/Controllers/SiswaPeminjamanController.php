<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class SiswaPeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman siswa
    public function index()
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            $peminjamans = collect();
        } else {
            $peminjamans = Peminjaman::with('buku')
                ->where('anggota_id', $anggota->id)
                ->latest('tanggal_pinjam')
                ->get();
        }

        return view('siswa.peminjaman', compact('peminjamans'));
    }

    // Memproses peminjaman buku
    public function store(Buku $buku)
    {
        $anggota = Auth::user()->anggota;

        // Memastikan akun siswa terhubung dengan anggota
        if (!$anggota) {
            return back()->with(
                'error',
                'Data anggota belum terhubung dengan akun kamu.'
            );
        }

        // Memeriksa apakah buku masih dipinjam oleh siswa
        $sudahPinjam = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $buku->id)
            ->whereNull('tanggal_kembali')
            ->exists();

        if ($sudahPinjam) {
            return back()->with(
                'error',
                'Buku ini masih dalam masa peminjaman kamu.'
            );
        }

        // Menyimpan data peminjaman
        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
        ]);

        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Buku "' . $buku->judul . '" berhasil dipinjam! Silakan cek riwayat peminjaman.'
            );
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Memeriksa hak akses menggunakan Policy
        Gate::authorize('view', $peminjaman);

        return view('siswa.detail-peminjaman', compact('peminjaman'));
    }
}

