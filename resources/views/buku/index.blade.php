@extends('layout.layoutnya')

@section('title')
    Daftar Buku
@endsection

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 py-10 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl">

            <!-- HEADER -->
            <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">

                <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">

                    <!-- BAGIAN TEKS (KIRI) -->
                    <div class="flex-1">

                        <p class="mb-2 text-sm font-medium text-white/80">
                            PERPUSTAKAAN 250441100072
                        </p>

                        <h2 class="text-3xl font-bold tracking-tight">
                            Daftar Buku
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-relaxed text-white/90">
                            Temukan berbagai koleksi buku menarik dan perluas
                            wawasanmu melalui Perpustakaan Digital.
                        </p>

                        <!-- TOMBOL KEMBALI KE DASHBOARD -->

                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                        @role('petugas')
                            <a href="{{ route('petugas.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                        @role('siswa')
                            <a href="{{ route('siswa.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                    </div>

                    <div class="flex h-40 w-40 shrink-0 items-center justify-center rounded-full border border-white/30 bg-white/15 shadow-xl backdrop-blur-sm md:h-52 md:w-52">

                        <img
                            src="{{ asset('image/read.png') }}"
                            alt="Logo Perpustakaan"
                            class="h-28 w-28 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-40 md:w-40">

                    </div>

                </div>
            </div>

            <!-- KONTEN DAFTAR BUKU -->
            <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Koleksi Buku
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Daftar buku yang tersedia di perpustakaan.
                        </p>
                    </div>

                    @can('kelola-buku')
                        <a href="{{ route('buku.form') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            Tambah Buku
                        </a>
                    @endcan

                </div>
                
                <hr class="mb-6 border-gray-100">

                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                    @forelse ($bukus as $buku)

                        <div class="group flex flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

                            <x-kartu-buku
                                :judul="$buku->judul"
                                :id="$buku->id"
                            >
                                <x-slot:tambahan>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Kategori: {{ $buku->kategori->nama ?? 'Tidak ada kategori' }}
                                    </p>
                                </x-slot:tambahan>
                            </x-kartu-buku>

                            {{-- Tombol khusus Siswa --}}
                            @role('siswa')
                                <div class="mt-4">

                                    <form action="{{ route('siswa.peminjaman.store', $buku->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-700">
                                            Pinjam Buku
                                        </button>

                                    </form>

                                </div>
                            @endrole

                            @can('kelola-buku')

                                <div class="mt-4 flex gap-2">

                                    {{-- Tombol Ubah --}}
                                    <a href="{{ route('buku.form.ubah', $buku->id) }}"
                                        class="rounded-lg bg-yellow-500 px-4 py-2 text-sm font-semibold text-white hover:bg-yellow-600">
                                        Ubah
                                    </a>

                                    {{-- Tombol Hapus menggunakan DELETE --}}
                                    <form action="{{ route('buku.hapus', $buku->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            @endcan
                        </div>

                    @empty

                        <p class="text-gray-500">
                            Data buku masih kosong.
                        </p>

                    @endforelse

                </div>
            </div>

            <!-- FOOTER -->
            <div class="mt-8 text-center text-sm text-gray-400">
                © 2026 Perpustakaan Digital 250441100072
            </div>

        </div>
    </div>
@endsection