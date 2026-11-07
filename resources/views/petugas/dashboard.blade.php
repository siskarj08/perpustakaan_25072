<x-app-layout>
    <div class="min-h-screen bg-gray-100 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="min-h-screen bg-blue-200 px-4 py-8 md:px-8">

                {{-- HEADER --}}
                <div class="mb-8 flex flex-col justify-between gap-5 md:flex-row md:items-center">

                    {{-- JUDUL DASHBOARD --}}
                    <div>
                        <p class="text-sm font-semibold text-indigo-600">
                            PANEL PETUGAS
                        </p>

                        <h1 class="mt-1 text-3xl font-bold text-slate-800">
                            Dashboard Petugas
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Selamat datang, {{ Auth::user()->name }}.
                            Kelola aktivitas perpustakaan melalui halaman ini.
                        </p>
                    </div>

                    {{-- PROFIL PETUGAS --}}
                    <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">

                        {{-- FOTO PROFIL --}}
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden">
                            <img src="{{ asset('image/petugas.png') }}"
                                alt="Foto Profil Petugas"
                                class="h-full w-full object-cover">
                        </div>

                        {{-- INFORMASI PROFIL --}}
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-slate-400">
                                PROFIL PENGGUNA
                            </p>

                            <h3 class="mt-1 truncate font-bold text-slate-800">
                                {{ Auth::user()->name }}
                            </h3>

                            <p class="text-sm text-slate-500">
                                {{ Auth::user()->email }}
                            </p>

                            <span class="mt-1 inline-block rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold capitalize text-indigo-600">
                                {{ Auth::user()->role }}
                            </span>
                        </div>

                        {{-- TOMBOL LIHAT PROFIL --}}
                        <a href="{{ route('profile.edit') }}"
                        class="ml-2 shrink-0 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            Lihat Profil
                        </a>

                    </div>

                </div>


                {{-- RINGKASAN --}}
                <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Total Buku</p>
                                <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $totalBuku }}
                                </h2>
                                <p class="mt-1 text-xs text-slate-400">Koleksi perpustakaan</p>
                            </div>

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 p-2">
                                <img src="{{ asset('image/tumpukan.png') }}"
                                    alt="Ikon Buku"
                                    class="h-full w-full object-contain">
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Total Peminjaman</p>
                                <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $totalPeminjaman }}
                                </h2>
                                <p class="mt-1 text-xs text-slate-400">Seluruh transaksi</p>
                            </div>

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 p-2">
                                <img src="{{ asset('image/pinjam.png') }}"
                                    alt="Ikon Buku"
                                    class="h-full w-full object-contain">
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Sedang Dipinjam</p>
                                <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $sedangDipinjam }}
                                </h2>
                                <p class="mt-1 text-xs text-slate-400">Belum dikembalikan</p>
                            </div>

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 p-2">
                                <img src="{{ asset('image/holding.png') }}"
                                    alt="Ikon Buku"
                                    class="h-full w-full object-contain">
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Sudah Dikembalikan</p>
                                <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                    {{ $sudahDikembalikan }}
                                </h2>
                                <p class="mt-1 text-xs text-slate-400">Transaksi selesai</p>
                            </div>

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-green-100 p-2">
                                <img src="{{ asset('image/ok.png') }}"
                                    alt="Ikon Dikembalikan"
                                    class="h-full w-full object-contain">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- MENU PETUGAS --}}
                <div class="mb-8">
                    <h2 class="mb-4 text-xl font-bold text-slate-800">
                        Menu Pengelolaan
                    </h2>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                        {{-- KELOLA BUKU --}}
                        <a href="{{ route('buku.index') }}"
                        class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 p-2">
                                <img src="{{ asset('image/book.png') }}"
                                    alt="Ikon Buku"
                                    class="h-full w-full object-contain">
                            </div>

                            <h3 class="font-bold text-slate-800">Kelola Data Buku</h3>

                            <p class="mt-2 text-sm text-slate-500">
                                Tambah, lihat, ubah, dan hapus koleksi buku.
                            </p>

                            <p class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                                Kelola Buku
                            </p>
                        </a>

                        {{-- PEMINJAMAN DAN PENGEMBALIAN --}}
                        <a href="{{ route('petugas.peminjaman') }}"
                        class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 p-2">
                                <img src="{{ asset('image/pencil.png') }}"
                                    alt="Ikon Buku"
                                    class="h-full w-full object-contain">
                            </div>

                            <h3 class="font-bold text-slate-800">
                                Peminjaman & Pengembalian
                            </h3>

                            <p class="mt-2 text-sm text-slate-500">
                                Kelola transaksi peminjaman dan proses pengembalian buku.
                            </p>

                            <p class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                                Kelola Transaksi
                            </p>
                        </a>

                        {{-- LAPORAN --}}
                        <a href="{{ route('petugas.laporan') }}"
                        class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                            <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-orange-100 p-2">
                                <img src="{{ asset('image/graph.png') }}"
                                    alt="Ikon Laporan"
                                    class="h-full w-full object-contain">
                            </div>

                            <h3 class="font-bold text-slate-800">
                                Laporan Perpustakaan
                            </h3>

                            <p class="mt-2 text-sm text-slate-500">
                                Lihat ringkasan dan riwayat transaksi perpustakaan.
                            </p>

                            <p class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                                Lihat Laporan
                            </p>
                        </a>

                    </div>
                </div>

            </div>
            <div class="mt-10 text-center text-sm text-gray-400">
                © 2026 Perpustakaan Digital 250441100072
            </div>

        </div>
    </div>
</x-app-layout>