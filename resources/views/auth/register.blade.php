<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-gray-950 dark:via-gray-900 dark:to-indigo-950">
        {{-- Dekorasi latar --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 dark:opacity-10">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 dark:opacity-10">
            </div>
        </div>

        <div class="w-full max-w-md relative z-10">
            {{-- Logo / Branding --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 shadow-2xl shadow-indigo-500/30 mb-4">
                    <i class="bi bi-box-seam text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Buat akun untuk memulai pengalaman luar biasa
                </p>
            </div>

            {{-- Kartu Utama --}}
            <div class="relative group">
                {{-- Border glow effect --}}
                <div
                    class="absolute -inset-0.5 bg-gradient-to-r from-cyan-400 to-purple-600 rounded-2xl opacity-30 group-hover:opacity-50 blur transition duration-500">
                </div>
                <div
                    class="relative bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" :value="__('Nama')"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-person text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <x-text-input id="name"
                                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 shadow-inner focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                                    type="text" name="name" :value="old('name')" required autofocus
                                    autocomplete="name" placeholder="Nama lengkap" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" :value="__('Email')"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-envelope text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <x-text-input id="email"
                                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 shadow-inner focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                                    type="email" name="email" :value="old('email')" required autocomplete="username"
                                    placeholder="nama@email.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi')"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-lock text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <x-text-input id="password"
                                    class="block w-full pl-10 pr-12 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 shadow-inner focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                                    type="password" name="password" required autocomplete="new-password"
                                    placeholder="Minimal 8 karakter" />
                                {{-- Tombol mata (toggle password) opsional, bisa dihilangkan --}}
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-shield-lock text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <x-text-input id="password_confirmation"
                                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 shadow-inner focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                                    type="password" name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Ketik ulang kata sandi" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Tombol Register --}}
                        <div class="pt-2">
                            <x-primary-button
                                class="w-full py-3.5 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-xl shadow-indigo-500/25 transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                                <i class="bi bi-person-plus text-lg"></i>
                                {{ __('Daftar') }}
                            </x-primary-button>
                        </div>
                    </form>

                    {{-- Sudah punya akun --}}
                    <div class="mt-6 text-center text-sm">
                        <span class="text-gray-500 dark:text-gray-400">{{ __('Sudah punya akun?') }}</span>
                        <a href="{{ route('login') }}"
                            class="ml-1 font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline transition">
                            {{ __('Masuk sekarang') }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Footer kecil --}}
            <p class="mt-8 text-center text-xs text-gray-400 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.
            </p>
        </div>
    </div>

    {{-- Sertakan Bootstrap Icons jika belum ada di layout --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @endpush
</x-guest-layout>
