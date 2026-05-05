<section>
    <div class="flex items-center gap-3 mb-6">
        <div class="p-2.5 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl shadow-lg">
            <i class="bi bi-person-vcard text-white text-xl"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Informasi Profil') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Perbarui nama dan alamat email akun Anda.') }}</p>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-1">
            <x-input-label for="name" :value="__('Nama')"
                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email')"
                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white/70 dark:bg-gray-900/70 shadow-inner focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div
                    class="mt-3 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800">
                    <p class="text-sm text-amber-800 dark:text-amber-200">
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button form="send-verification"
                            class="underline font-medium text-amber-700 dark:text-amber-300 hover:text-amber-900 dark:hover:text-amber-100 ml-1">
                            {{ __('Kirim ulang email verifikasi.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                {{ __('Simpan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
