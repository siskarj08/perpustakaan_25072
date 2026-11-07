<x-app-layout>
    <div class="min-h-screen bg-gray-300 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">
                <h1 class="text-3xl font-bold">
                    Dashboard Siswa
                </h1>

                <p class="mt-2 text-blue-50">
                    Selamat datang, {{ Auth::user()->name }}!
                </p>

                <p class="mt-1 text-sm text-white/90">
                    Temukan buku favorit dan pantau aktivitas peminjamanmu.
                </p>
            </div>

            <!-- Menu Utama -->
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Daftar Buku -->
                <a href="{{ route('buku.index') }}"
                   class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ asset('image/book.png') }}"
                        alt="Ilustrasi Membaca"
                        class="h-14 w-14 mb-4">

                    <h2 class="text-lg font-bold text-gray-800">
                        Daftar Buku
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Lihat koleksi buku yang tersedia di perpustakaan.
                    </p>

                    <span class="mt-4 inline-block rounded-xl bg-indigo-500 hover:bg-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        Lihat Buku
                    </span>
                </a>

                <!-- Profil -->
                <a href="{{ route('profile.edit') }}"
                   class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ asset('image/hacker.png') }}"
                        alt="Ilustrasi Membaca"
                        class="h-14 w-14 mb-4">

                    <h2 class="text-lg font-bold text-gray-800">
                        Profil Saya
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Lihat dan perbarui informasi akun pribadi.
                    </p>

                    <span class="mt-4 inline-block rounded-xl bg-indigo-500 hover:bg-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        Kelola Profil
                    </span>
                </a>

                <a href="{{ route('siswa.peminjaman.index') }}"
                   class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ asset('image/caution.png') }}"
                        alt="Ilustrasi Membaca"
                        class="h-16 w-16 mb-4">

                    <h2 class="text-lg font-bold text-gray-800 mt-4">
                        Riwayat Peminjaman
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Pantau daftar buku yang pernah kamu pinjam.
                    </p>

                    <span class="mt-4 inline-block rounded-xl bg-indigo-500 hover:bg-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        Lihat Riwayat
                    </span>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
