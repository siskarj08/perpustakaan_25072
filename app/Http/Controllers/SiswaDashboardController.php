<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')
            ->latest()
            ->take(6)
            ->get();

        return view('siswa.dashboard', compact('bukus'));
    }
}