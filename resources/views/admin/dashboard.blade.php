<x-app-layout>
    <div class="min-h-screen bg-blue-100 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <!-- HEADER -->
            <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">

                <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-center">

                    <div>
                        <p class="mb-2 text-sm font-medium text-white/80">
                            PERPUSTAKAAN 250441100072
                        </p>

                        <h1 class="text-3xl font-bold tracking-tight">
                            Dashboard Admin
                        </h1>

                        <p class="mt-2 text-sm leading-relaxed text-white/90">
                            Selamat datang, {{ Auth::user()->name }}!
                            Kelola seluruh aktivitas dan data perpustakaan melalui dashboard admin.
                        </p>
                    </div>

                    <div class="flex h-36 w-36 shrink-0 items-center justify-center rounded-full border border-white/30 bg-white/15 shadow-xl backdrop-blur-sm md:mr-4 md:h-44 md:w-44">
                        <img
                            src="{{ asset('image/read.png') }}"
                            alt="Logo Perpustakaan"
                            class="h-28 w-28 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-36 md:w-36">
                    </div>

                </div>
            </div>

            <!-- PROFIL ADMIN -->
            <div class="mb-8 rounded-2xl border border-gray-100 bg-white p-6 shadow-md">
                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                    <!-- Informasi Profil -->
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden">
                            <img
                                src="{{ asset('image/admin.png') }}"
                                alt="Foto Admin"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Profil Pengguna
                            </p>

                            <h2 class="mt-1 text-lg font-bold text-gray-800">
                                {{ Auth::user()->name }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                {{ Auth::user()->email }}
                            </p>

                            <span class="mt-2 inline-block rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold capitalize text-indigo-700">
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>

                    <!-- Tombol Profil -->
                    <a
                        href="{{ route('profile.edit') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-indigo-700"
                    >
                        Lihat Profil
                    </a>

                </div>
            </div>

            <!-- MENU ADMIN -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    Menu Pengelolaan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Pilih menu untuk mengelola sistem perpustakaan.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <!-- KELOLA BUKU -->
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-yellow-200 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/book.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>

                    <h3 class="text-lg font-bold text-gray-800 transition group-hover:text-blue-600">
                        Kelola Data Buku
                    </h3>

                    <p class="mt-2 min-h-16 text-sm leading-relaxed text-gray-500">
                        Tambah, lihat, ubah, dan hapus koleksi buku perpustakaan.
                    </p>

                    <a href="{{ route('buku.index') }}"
                       class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                        Kelola Buku
                    </a>
                </div>

                <!-- KELOLA PENGGUNA -->
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-yellow-200 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/group.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>

                    <h3 class="text-lg font-bold text-gray-800 transition group-hover:text-indigo-600">
                        Kelola Pengguna
                    </h3>

                    <p class="mt-2 min-h-16 text-sm leading-relaxed text-gray-500">
                        Kelola akun pengguna dan atur hak akses admin, petugas, serta siswa.
                    </p>

                    <a href="{{ route('admin.pengguna') }}"
                       class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                        Kelola Pengguna
                    </a>
                </div>

                <!-- PEMINJAMAN DAN PENGEMBALIAN -->
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-pink-100 p-2 md:h-20 md:w-20">
                        <img
                            src="{{ asset('image/pencil.png') }}"
                            alt="Ikon Tumpukan Buku"
                            class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 transition group-hover:text-pink-600">
                        Peminjaman & Pengembalian
                    </h3>

                    <p class="mt-2 min-h-16 text-sm leading-relaxed text-gray-500">
                        Akses dan kelola seluruh transaksi peminjaman serta pengembalian buku.
                    </p>

                    <a href="{{ route('admin.peminjaman') }}"
                       class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                        Kelola Transaksi
                    </a>
                </div>

                <!-- LAPORAN -->
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-purple-200 hover:shadow-lg">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-purple-100 p-2 md:h-20 md:w-20">
                        <img
                            src="{{ asset('image/graph.png') }}"
                            alt="Ikon Tumpukan Buku"
                            class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 transition group-hover:text-purple-600">
                        Laporan Perpustakaan
                    </h3>

                    <p class="mt-2 min-h-16 text-sm leading-relaxed text-gray-500">
                        Lihat laporan koleksi buku dan aktivitas peminjaman perpustakaan.
                    </p>

                    <a href="{{ route('admin.laporan') }}"
                       class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                        Lihat Laporan
                    </a>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="mt-10 text-center text-sm text-gray-400">
                © 2026 Perpustakaan Digital 250441100072
            </div>

        </div>
    </div>
</x-app-layout>