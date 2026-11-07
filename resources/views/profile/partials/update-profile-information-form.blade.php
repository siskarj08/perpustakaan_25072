<section>
    <header class="mb-6 border-b border-gray-100 pb-5">
        <h2 class="text-xl font-bold tracking-tight text-gray-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm leading-relaxed text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="font-semibold text-gray-700" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-xl border border-yellow-100 bg-yellow-50 p-4">
                    <p class="mt-1 text-sm text-yellow-800">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            class="rounded-md text-sm font-semibold text-indigo-600 underline decoration-indigo-300 underline-offset-4 transition hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4 border-t border-gray-100 pt-5">
            <x-primary-button class="rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>