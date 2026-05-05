<section>
    <div class="flex items-center gap-3 mb-6">
        <div class="p-2.5 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl shadow-lg">
            <i class="bi bi-shield-lock text-white text-xl"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Perbarui Kata Sandi') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Gunakan kata sandi yang panjang dan acak agar tetap aman.') }}</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-1">
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')"
                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all duration-300"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-1">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')"
                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all duration-300"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-1">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')"
                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all duration-300"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="px-6 py-3 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white rounded-xl font-semibold shadow-lg shadow-amber-400/30 transition-all duration-300 transform hover:-translate-y-0.5">
                {{ __('Simpan') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
