<section>
    <header class="mb-6 border-b border-gray-100 pb-5">
        <h2 class="text-xl font-bold tracking-tight text-gray-800">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm leading-relaxed text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label
                for="update_password_current_password"
                :value="__('Current Password')"
                class="font-semibold text-gray-700"
            />
            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label
                for="update_password_password"
                :value="__('New Password')"
                class="font-semibold text-gray-700"
            />
            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirm Password')"
                class="font-semibold text-gray-700"
            />
            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center gap-4 border-t border-gray-100 pt-5">
            <x-primary-button class="rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
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