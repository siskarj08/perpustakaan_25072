<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')
            ->orderBy('id', 'asc')
            ->get();

        return BukuResource::collection($buku);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1',
        ]);

        $buku = Buku::create($data);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $buku->load('kategori'),
        ], 201);
    }

    public function show(Buku $buku)
    {
        $buku->load('kategori');

        return new BukuResource($buku);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori_id' => $request->kategori_id,
        ]);

        return response()->json([
            'message' => 'Buku berhasil diperbarui!',
            'data' => $buku->load('kategori'),
        ]);
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        $bukuLain = Buku::orderBy('id', 'asc')->get();

        foreach ($bukuLain as $index => $item) {
            $idBaru = $index + 1;

            if ($item->id != $idBaru) {
                $item->id = $idBaru;
                $item->saveQuietly();
            }
        }

        return response()->json([
            'message' => 'Buku berhasil dihapus dan ID telah diurutkan ulang.',
            'status' => 200
        ], 200);
    }
}





