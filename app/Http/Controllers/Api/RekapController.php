<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function bukuPerKategori()
    {
        $rekap = Kategori::withCount('bukus')->get();

        return response()->json([
            'data' => $rekap->map(function ($kategori) {
                return [
                    'kategori_id' => $kategori->id,
                    'nama_kategori' => $kategori->nama,
                    'jumlah_buku' => $kategori->bukus_count,
                ];
            }),
        ], 200);
    }

    public function peminjamanPerBuku()
    {
        $rekap = Buku::withCount('peminjamans')->get();

        return response()->json([
            'data' => $rekap->map(function ($buku) {
                return [
                    'buku_id' => $buku->id,
                    'judul' => $buku->judul,
                    'total_peminjaman' => $buku->peminjamans_count,
                ];
            }),
        ], 200);
    }
}