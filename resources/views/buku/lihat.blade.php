@extends('layout.layoutnya')

@section('title')
    Detail Buku
@endsection

@section('content')

<div class="min-h-screen bg-gray-100 px-4 py-10 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-5xl">

        <!-- HEADER -->
        <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">

            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">

                    <div class="flex-1 text-center sm:text-left">

                        <p class="mb-2 text-sm font-medium text-white/80">
                            PERPUSTAKAAN 250441100072
                        </p>

                        <h2 class="text-3xl font-bold tracking-tight">
                            Detail Buku
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-relaxed text-white/90">
                            Informasi lengkap mengenai koleksi buku yang tersedia
                            di Perpustakaan Digital.
                        </p>

                    </div>

                    <div class="flex h-40 w-40 shrink-0 items-center justify-center padding-right-20 rounded-full border border-white/30 bg-white/15 shadow-xl backdrop-blur-sm md:mr-4 md:h-52 md:w-52">

                        <img
                            src="{{ asset('image/read.png') }}"
                            alt="Logo Perpustakaan"
                            class="h-28 w-28 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-40 md:w-40">

                    </div>

                </div>
            </div>
        </div>

        <!-- KONTEN DETAIL BUKU -->
        <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">

            @if ($databuku)

                <div class="flex flex-col gap-6 sm:flex-row">

                    <!-- INFORMASI BUKU -->
                    <div class="flex-1">

                        <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                            {{ $databuku->kategori->nama ?? 'Tanpa Kategori' }}
                        </span>

                        <h3 class="mt-4 text-2xl font-bold text-gray-800">
                            {{ $databuku->judul }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Informasi lengkap buku
                        </p>

                        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <!-- ID BUKU -->
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium text-gray-400">
                                    ID Buku
                                </p>

                                <p class="mt-1 font-semibold text-gray-800">
                                    #{{ $databuku->id }}
                                </p>
                            </div>

                            <!-- PENULIS -->
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium text-gray-400">
                                    Penulis
                                </p>

                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $databuku->penulis }}
                                </p>
                            </div>

                            <!-- TAHUN TERBIT -->
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium text-gray-400">
                                    Tahun Terbit
                                </p>

                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $databuku->tahun_terbit }}
                                </p>
                            </div>

                            <!-- KATEGORI -->
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium text-gray-400">
                                    Kategori
                                </p>

                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $databuku->kategori->nama ?? 'Tidak ada kategori' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- TOMBOL KEMBALI -->
                <div class="mt-8 border-t border-gray-100 pt-6">

                    <a href="{{ route('buku.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        Kembali ke Daftar Buku

                    </a>

                </div>

            @else

                <!-- JIKA BUKU TIDAK DITEMUKAN -->
                <div class="py-12 text-center">

                    <div class="mb-5 text-6xl">
                        📚
                    </div>

                    <h3 class="text-xl font-bold text-gray-800">
                        Buku Tidak Ditemukan
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                        Maaf, data buku yang Anda cari tidak tersedia
                        di dalam koleksi perpustakaan.
                    </p>

                    <a href="{{ route('buku.index') }}"
                       class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <span>←</span>
                        Kembali ke Daftar Buku

                    </a>

                </div>

            @endif

        </div>
    </div>

</div>

@endsection
