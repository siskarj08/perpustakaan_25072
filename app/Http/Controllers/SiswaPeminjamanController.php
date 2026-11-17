<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SiswaPeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman siswa
    public function index()
    {
        $user = Auth::user();
        $anggota = Anggota::where('user_id', $user->id)->first()
            ?? Anggota::where('email', $user->email)
                ->whereNull('user_id')
                ->first();

        $peminjamans = $anggota
            ? Peminjaman::with('buku')
                ->where('anggota_id', $anggota->id)
                ->latest('tanggal_pinjam')
                ->get()
            : collect();

        return view('siswa.peminjaman', compact('peminjamans'));
    }

    // Memproses peminjaman buku
    public function store(Buku $buku)
    {
        $anggota = $this->resolveAnggotaFor(Auth::user());

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
                'Buku "'.$buku->judul.'" berhasil dipinjam! Silakan cek riwayat peminjaman.'
            );
    }

    private function resolveAnggotaFor(User $user): Anggota
    {
        return DB::transaction(function () use ($user) {

            // Cari anggota berdasarkan user_id
            $anggota = Anggota::where('user_id', $user->id)
                ->first();

            if ($anggota) {
                return $anggota;
            }

            // Cari anggota berdasarkan email
            $anggota = Anggota::where('email', $user->email)
                ->whereNull('user_id')
                ->first();

            if ($anggota) {
                $anggota->user_id = $user->id;
                $anggota->save();

                return $anggota;
            }

            // Buat anggota baru tanpa nomor telepon
            return Anggota::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
            ]);
        });
    }

    // Menampilkan detail peminjaman
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])
            ->findOrFail($id);

        Gate::authorize('view', $peminjaman);

        return view('siswa.detail-peminjaman', compact('peminjaman'));
    }
}
