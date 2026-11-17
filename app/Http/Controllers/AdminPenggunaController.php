<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminPenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::latest()->paginate(10);

        return view('admin.pengguna', compact('pengguna'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                Rule::exists('roles', 'name')->where('guard_name', 'web'),
            ],
        ]);

        if ($user->is(auth()->user())) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akun sendiri.');
        }

        DB::transaction(function () use ($user, $validated): void {
            $user->forceFill(['role' => $validated['role']])->save();
            $user->syncRoles([$validated['role']]);
        });

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
