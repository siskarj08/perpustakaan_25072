<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return view('buku.index', compact('kategoris'));
    }

    public function lihat($id)
    {
        $databuku = Buku::with('kategori')->find($id);

        return view('buku.lihat', compact('databuku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        Buku::create($validated);

        return redirect()
            ->route('buku.index', [], 303)
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function ubah($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('buku.form', compact('buku', 'kategoris'));
    }
}



