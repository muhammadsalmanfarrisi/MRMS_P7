<section class="space-y-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="p-2.5 bg-gradient-to-br from-red-400 to-rose-500 rounded-xl shadow-lg">
            <i class="bi bi-exclamation-octagon text-white text-xl"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Hapus Akun') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Setelah akun dihapus, semua data dan sumber daya akan hilang permanen. Unduh data penting terlebih dahulu.') }}
            </p>
        </div>
    </div>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 transition-all duration-300 transform hover:-translate-y-0.5">{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div
            class="p-8 bg-white dark:bg-gray-800 rounded-3xl shadow-2xl backdrop-blur-xl border border-white/20 dark:border-gray-700/50 max-w-lg w-full mx-auto transform transition-all">
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div class="text-center">
                    <div
                        class="mx-auto mb-4 w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center">
                        <i class="bi bi-exclamation-triangle text-red-600 dark:text-red-400 text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Yakin ingin menghapus akun?') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Semua data akan dihapus permanen. Masukkan kata sandi untuk konfirmasi.') }}
                    </p>
                </div>

                <div class="space-y-1">
                    <x-input-label for="password" value="{{ __('Kata Sandi') }}"
                        class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                    <x-text-input id="password" name="password" type="password"
                        class="mt-1 block w-full rounded-xl border-red-300 dark:border-red-700 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all duration-300"
                        placeholder="{{ __('Kata Sandi') }}" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close')"
                        class="px-5 py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-danger-button
                        class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 transition-all duration-300">
                        {{ __('Hapus Akun') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
