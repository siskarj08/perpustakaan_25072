<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();
        $role = $user->role;

        if (! in_array($role, ['admin', 'petugas', 'siswa'], true)) {
            abort(403, 'Role pengguna tidak ditemukan.');
        }

        $user->syncRoles([$role]);

        // Jika pengguna adalah siswa, daftarkan otomatis sebagai anggota
        if ($role === 'siswa') {
            $user->anggota()->firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $user->name,
                    'email' => $user->email,
                ]
            );
        }

        return redirect()->route($role.'.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
