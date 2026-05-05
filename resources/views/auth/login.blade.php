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

                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Masuk untuk melanjutkan ke sistem
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

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

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
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="nama@email.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" :value="__('Password')"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-300" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-lock text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <x-text-input id="password"
                                    class="block w-full pl-10 pr-12 py-3 rounded-xl border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 shadow-inner focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Kata sandi" />

                                {{-- Toggle password visibility --}}
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none transition-colors duration-200">
                                    <!-- Eye Open -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open block"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye Off -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-off hidden"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.358-3.918m2.674-1.874A9.959 9.959 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-4.234 5.152M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Remember Me & Forgot Password --}}
                        <div class="flex justify-between items-center">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 bg-white dark:bg-gray-800 focus:ring-indigo-500 transition-all"
                                    name="remember">
                                <span
                                    class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingatkan Saya') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>

                        {{-- Tombol Login --}}
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3.5 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-xl shadow-indigo-500/25 transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                                <i class="bi bi-box-arrow-in-right text-lg"></i>
                                {{ __('Masuk') }}
                            </button>
                        </div>
                    </form>


                </div>
            </div>

            {{-- Footer kecil --}}
            <p class="mt-8 text-center text-xs text-gray-400 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.
            </p>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeOff = btn.querySelector('.eye-off');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @endpush
</x-guest-layout>
