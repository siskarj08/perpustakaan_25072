<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-8 py-6 text-white shadow-lg">
            <h2 class="text-2xl font-bold tracking-tight">
                {{ __('Profile') }}
            </h2>
            <p class="mt-2 text-sm text-white/90">
                Kelola informasi profil, kata sandi, dan akun perpustakaanmu.
            </p>

            <div class="mt-5">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/15 px-5 py-2.5 text-sm font-semibold text-white shadow-sm backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:bg-white/25 hover:shadow-md">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">

            <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm transition duration-300 hover:shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm transition duration-300 hover:shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm transition duration-300 hover:shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>