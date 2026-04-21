<x-guest-layout>
    <div
        class="w-full max-w-md bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-8 transition-all duration-300 text-gray-700 dark:text-gray-300">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white transition-colors duration-300">
            Selamat Datang Kembali
        </h2>
        <p class="text-gray-500 text-center dark:text-gray-400 transition-colors duration-300">
            Masuk untuk melanjutkan ke system
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mt-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email"
                    class="block w-full mt-1 px-4 py-3 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />

                <div class="relative">
                    <x-text-input id="password"
                        class="block w-full mt-1 pr-10 px-4 py-3 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                        type="password" name="password" required autocomplete="current-password" />

                    <!-- Toggle password visibility -->
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300 focus:outline-none">
                        <!-- Eye Open -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Off -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-off hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.358-3.918m2.674-1.874A9.959 9.959 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-4.234 5.152M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded text-blue-600 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring-blue-500 dark:focus:ring-blue-400 transition-all duration-300"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingatkan Saya') }}</span>
                </label>
                {{-- @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-all duration-300"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif --}}
            </div>

            <!-- Login Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white dark:text-white rounded-lg shadow-md text-lg font-semibold transition-all ease-in-out duration-300">
                    {{ __('Masuk') }}
                </button>
            </div>

            <!-- Sign Up Link -->
            <p class="text-center text-gray-600 dark:text-gray-400 mt-4 transition-colors duration-300">Tidak Punya
                Akun?
                <a href="{{ route('register') }}"
                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold transition-all duration-300">
                    Daftar
                </a>
            </p>
        </form>
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

</x-guest-layout>
