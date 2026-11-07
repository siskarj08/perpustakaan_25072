<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminPenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::latest()->paginate(10);

        return view('admin.pengguna', compact('pengguna'));
    }

     public function updateRole(Request $request, User $user)
    {
        // Validasi role
        $request->validate([
            'role' => 'required|in:admin,petugas,siswa',
        ]);

        // Mencegah admin mengubah role akunnya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akun sendiri.');
        }

        // Simpan perubahan role
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}