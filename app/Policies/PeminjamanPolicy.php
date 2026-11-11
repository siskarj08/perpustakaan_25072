<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;
use App\Policies\PeminjamanPolicy;
use Illuminate\Support\Facades\Gate;

class PeminjamanPolicy
{
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        // Admin dan Petugas boleh melihat semua peminjaman
        if ($user->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }

        // Siswa hanya boleh melihat peminjaman miliknya sendiri
        return $peminjaman->anggota?->user_id === $user->id;
    }
    
    public function boot(): void
    {
        // Gate pengelolaan buku
        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // Policy peminjaman
        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
    }
}