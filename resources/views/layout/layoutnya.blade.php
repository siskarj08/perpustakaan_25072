<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-200 text-gray-800">

    <nav class="border-b border-gray-300 bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            @if (!request()->routeIs('home'))
            <a href="{{ route('home') }}"
               class="text-lg font-bold text-blue-700 transition hover:text-pink-500">
                Perpustakaan<span class="text-pink-500">072</span>
            </a>
            @endif

            @if (!request()->routeIs('home'))
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">

                    <span aria-hidden="true">←</span>
                    <span>Beranda</span>
                </a>
            @endif

        </div>
    </nav>

    <main class="min-h-[calc(100vh-140px)]">
        @yield('content')
    </main>

    <footer class="mt-10 border-t border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-5 text-center text-sm text-gray-500">
            &copy; 2026 Perpustakaan072. Semua hak dilindungi.
        </div>
    </footer>

</body>

</html>
```