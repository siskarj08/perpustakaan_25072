<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Hak akses pengelolaan buku
        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // Memaksa HTTPS ketika aplikasi production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
