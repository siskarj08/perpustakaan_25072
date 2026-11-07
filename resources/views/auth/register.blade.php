<x-guest-layout>
    <div class="w-full">

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-8 py-7 text-center">

                <div class="flex justify-center mb-3">
                    <img
                        src="{{ asset('image/read.png') }}"
                        alt="Logo Perpustakaan"
                        class="w-16 h-16 object-contain"
                    >
                </div>

                <h1 class="text-2xl font-bold text-white tracking-wide">
                    Perpustakaan Digital
                </h1>

                <p class="text-pink-100 text-sm mt-2">
                    Bergabunglah dan temukan berbagai koleksi buku menarik.
                </p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-7">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        Buat Akun Baru
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Silakan lengkapi data berikut untuk mendaftar.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label
                            for="name"
                            :value="__('Nama Lengkap')"
                            class="font-semibold text-gray-700"
                        />

                        <x-text-input
                            id="name"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="text"
                            name="name"
                            :value="old('name')"
                            placeholder="Masukkan nama lengkap"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-5">
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="font-semibold text-gray-700"
                        />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="email"
                            name="email"
                            :value="old('email')"
                            placeholder="Masukkan email Anda"
                            required
                            autocomplete="username"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mt-5">
                        <x-input-label
                            for="no_telepon"
                            :value="__('Nomor Telepon')"
                            class="font-semibold text-gray-700"
                        />

                            <x-text-input
                                id="no_telepon"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                                type="tel"
                                name="no_telepon"
                                :value="old('no_telepon')"
                                placeholder="Masukkan nomor telepon"
                                required
                                autocomplete="tel"
                            />

                            <x-input-error
                                :messages="$errors->get('no_telepon')"
                                class="mt-2"
                            />
                        </div>

                    </div>

                    <!-- Password -->
                    <div class="mt-5">
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="font-semibold text-gray-700"
                        />

                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="password"
                            name="password"
                            placeholder="Buat password Anda"
                            required
                            autocomplete="new-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-5">
                        <x-input-label
                            for="password_confirmation"
                            :value="__('Konfirmasi Password')"
                            class="font-semibold text-gray-700"
                        />

                        <x-text-input
                            id="password_confirmation"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-pink-500 focus:ring-pink-500 py-3"
                            type="password"
                            name="password_confirmation"
                            placeholder="Masukkan ulang password"
                            required
                            autocomplete="new-password"
                        />

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Register Button -->
                    <div class="mt-7">
                        <x-primary-button class="w-full justify-center py-3 rounded-xl bg-gradient-to-r from-blue-600 to-pink-500 hover:from-blue-700 hover:to-pink-600 active:bg-pink-700 focus:ring-pink-500 transition duration-200 text-sm font-bold tracking-wide">
                            DAFTAR SEKARANG
                        </x-primary-button>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500">
                            Sudah memiliki akun?

                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-pink-600 hover:text-blue-700 transition"
                            >
                                Login di sini
                            </a>
                        </p>
                    </div>

                </form>

                <!-- Footer -->
                <div class="mt-6 pt-5 border-t border-gray-100 text-center">
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