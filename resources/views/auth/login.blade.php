<x-guest-layout>
    <div class="w-full">

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-center">

                <div class="flex justify-center mb-4">
                    <img src="{{ asset('image/read.png') }}" alt="Logo" class="w-16 h-16">
                </div>

                <h1 class="text-2xl font-bold text-white tracking-wide">
                    Perpustakaan 250441100072
                </h1>

                <p class="text-pink-100 text-sm mt-2">
                    Selamat datang kembali! Silakan login ke akun Anda.
                </p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        Login Akun
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Masukkan email dan password untuk melanjutkan.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="email"
                            name="email"
                            :value="old('email')"
                            placeholder="Masukkan email Anda"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-5">
                        <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />

                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="password"
                            name="password"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Forgot Password -->
                    <div class="flex justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-pink-600 hover:text-blue-700 font-medium transition"
                                href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="mt-7">
                        <x-primary-button class="w-full justify-center py-3 rounded-xl bg-gradient-to-r from-blue-600 to-pink-500 hover:from-blue-700 hover:to-pink-600 focus:ring-pink-500 transition duration-200 text-sm font-bold tracking-wide">
                            LOGIN SEKARANG
                        </x-primary-button>
                    </div>

                </form>

                <!-- Register Button -->
                @if (Route::has('register'))
                    <div class="mt-4">
                        <a href="{{ route('register') }}"
                            class="flex items-center justify-center w-full py-3 rounded-xl border-2 border-blue-500 text-blue-600 hover:bg-gradient-to-r hover:from-blue-50 hover:to-pink-50 hover:border-pink-400 hover:text-pink-600 transition duration-200 text-sm font-bold">

                            BELUM PUNYA AKUN? DAFTAR SEKARANG

                        </a>
                    </div>
                @endif

                <!-- Footer -->
                <div class="mt-7 pt-5 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400">
                        Sistem Perpustakaan Digital
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Akses informasi dan koleksi buku dengan mudah.
                    </p>
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>