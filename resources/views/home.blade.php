@extends('layout.layoutnya')

@section('title')
    Beranda
@endsection

@section('content')

    <div class="relative flex min-h-[calc(100vh-160px)] items-center justify-center overflow-hidden bg-gray-100 px-6 py-16">

        <!-- Dekorasi Background -->
        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-blue-200/40 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-pink-200/40 blur-3xl"></div>

        <div class="beranda relative mx-auto w-full max-w-6xl">

            <!-- Hero Section -->
            <div class="overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 shadow-2xl">

                <div class="grid grid-cols-1 items-center gap-10 px-8 py-16 md:grid-cols-2 md:px-14 md:py-20">

                    <!-- Teks Beranda -->
                    <div class="beranda-text text-center md:text-left">

                        <h2 class="mt-6 text-4xl font-extrabold leading-tight text-white md:text-5xl">
                            Selamat Datang di
                            <span class="block text-yellow-200">
                                Perpustakaan072
                            </span>
                        </h2>

                        <p class="mt-6 max-w-xl text-base leading-8 text-white/90 md:text-lg">
                            Temukan berbagai koleksi buku dan informasi menarik
                            yang tersedia di Perpustakaan072. Jelajahi koleksi kami
                            dan temukan buku yang sesuai dengan minatmu.
                        </p>

                        <a href="{{ route('login') }}"
                           class="mt-8 inline-flex items-center gap-3 rounded-xl bg-white px-7 py-3.5 font-bold text-blue-700 shadow-lg transition duration-300 hover:-translate-y-1 hover:bg-blue-50 hover:shadow-xl">

                            <span>Masuk Untuk Jelajahi</span>
                        </a>
                    </div>

                    <!-- Ilustrasi -->
                    <div class="flex items-center justify-center">

                        <div class="flex flex-col items-center justify-center text-center">

                            <!-- Lingkaran Background -->
                            <div class="flex h-64 w-64 items-center justify-center rounded-full border border-white/30 bg-white/15 shadow-xl backdrop-blur-sm md:h-80 md:w-80">

                                <!-- Logo -->
                                <img
                                    src="{{ asset('image/read.png') }}"
                                    alt="Ilustrasi Membaca"
                                    class="h-40 w-40 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-52 md:w-52"
                                >

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection