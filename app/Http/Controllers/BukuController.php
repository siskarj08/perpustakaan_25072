<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        $bukus = Buku::with('kategori')
            ->orderBy('id', 'asc')
            ->get();

        return view('buku.index', compact('kategoris', 'bukus'));
    }

    public function lihat($id)
    {
        $databuku = Buku::with('kategori')->findOrFail($id);

        return view('buku.lihat', compact('databuku'));
    }

    // Menambahkan buku
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        $buku = Buku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan!',
            'data' => $buku
        ], 201);
    }

    // Menampilkan form ubah buku
    public function ubah($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('buku.form', compact('buku', 'kategoris'));
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        $buku = Buku::findOrFail($id);

        $buku->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diperbarui!',
            'data' => $buku
        ]);
    }

    public function cari(Request $request)
    {
        $judul = $request->judul;

        $buku = DB::select(
            "SELECT * FROM bukus WHERE judul = ?",
            [$judul]
        );

        return response()->json($buku);
    }

    public function destroy($buku)
    {
        $dataBuku = Buku::findOrFail($buku);

        $dataBuku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
