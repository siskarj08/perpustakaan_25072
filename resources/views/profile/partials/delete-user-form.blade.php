<section class="space-y-6">
    <header class="mb-6 border-b border-gray-100 pb-5">
        <h2 class="text-xl font-bold tracking-tight text-gray-800">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm leading-relaxed text-gray-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-xl bg-gradient-to-r from-red-500 to-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6 p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold tracking-tight text-gray-800">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm leading-relaxed text-gray-500">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="rounded-xl border border-red-100 bg-red-50 p-4">
                <x-input-label for="password" value="{{ __('Password') }}" class="font-semibold text-gray-700" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-red-400 focus:ring-2 focus:ring-red-100"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-gray-100 pt-5">
                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="rounded-xl bg-gradient-to-r from-red-500 to-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:shadow-lg focus:ring-2 focus:ring-red-300 focus:ring-offset-2">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>