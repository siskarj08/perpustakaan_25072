<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
    $buku = Buku::with('kategori')
        ->withCount('peminjamans');

    if ($request->filled('cari')) {
        $cari = $request->cari;

        $buku->where(function ($query) use ($cari) {
            $query->where('judul', 'like', '%' . $cari . '%')
                  ->orWhere('penulis', 'like', '%' . $cari . '%');
        });
    }

    if ($request->filled('kategori')) {
        $buku->where('kategori_id', $request->kategori);
    }

    if ($request->filled('tahun')) {
        $buku->where('tahun_terbit', $request->tahun);
    }

    $sort = $request->query('sort', 'id');
    $order = $request->query('order', 'asc');

    $kolomDiizinkan = [
        'id',
        'judul',
        'penulis',
        'tahun_terbit'
    ];

    if (!in_array($sort, $kolomDiizinkan)) {
        $sort = 'tahun_terbit';
    }

    if (!in_array($order, ['asc', 'desc'])) {
        $order = 'desc';
    }

    $buku->orderBy($sort, $order);

    if ($sort !== 'id') {
        $buku->orderByDesc('id');
    }

    $data = $buku->paginate(10)->withQueryString();

    return response()->json([
        'data' => $data->items(),
        'meta' => [
            'current_page' => $data->currentPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
            'last_page' => $data->lastPage(),
        ],
        'links' => [
            'first' => $data->url(1),
            'last' => $data->url($data->lastPage()),
            'prev' => $data->previousPageUrl(),
            'next' => $data->nextPageUrl(),
        ],
    ], 200);
    }

    public function store(StoreBukuRequest $request)
    {
        $buku = Buku::create($request->validated());

        $buku->load('kategori');

        return response()->json([
            'message' => 'Data buku berhasil ditambahkan.',
            'data' => $buku,
        ]);
    }

    public function show(string $id)
    {
        $buku = Buku::with(['kategori', 'peminjamans'])
            ->find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Data buku tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data' => $buku,
        ], 200);
    }

    public function update(UpdateBukuRequest $request, string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Data buku tidak ditemukan.',
            ], 404);
        }

        $buku->update($request->validated());

        $buku->load('kategori');

        return response()->json([
            'message' => 'Data buku berhasil diperbarui.',
            'data' => $buku,
        ], 200);
    }

    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Data buku tidak ditemukan.',
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'message' => 'Data buku berhasil dihapus.',
        ], 200);
    }
}


