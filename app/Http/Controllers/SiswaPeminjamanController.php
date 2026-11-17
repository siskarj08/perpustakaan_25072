<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SiswaPeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman siswa
    public function index(): View
    {
        $anggota = $this->resolveAnggotaFor(auth()->user());

        $peminjamans = $anggota->peminjamans()
            ->with('buku')
            ->latest('tanggal_pinjam')
            ->get();

        return view('siswa.peminjaman', compact('peminjamans'));
    }

    // Memproses peminjaman buku
    public function store(Buku $buku)
    {
        $anggota = $this->resolveAnggotaFor(Auth::user());

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
                'Buku "'.$buku->judul.'" berhasil dipinjam! Silakan cek riwayat peminjaman.'
            );
    }

    private function resolveAnggotaFor(User $user): Anggota
    {
        return DB::transaction(function () use ($user): Anggota {
            $anggota = $user->anggota()->first();

            if ($anggota) {
                return $anggota;
            }

            $anggota = Anggota::query()
                ->where('email', $user->email)
                ->whereNull('user_id')
                ->first();

            if ($anggota) {
                $anggota->user()->associate($user);
                $anggota->save();

                return $anggota;
            }

            return $user->anggota()->create([
                'nama' => $user->name,
                'email' => $user->email,
            ]);
        });
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Memeriksa hak akses menggunakan Policy
        Gate::authorize('view', $peminjaman);

        return view('siswa.detail-peminjaman', compact('peminjaman'));
    }
}
