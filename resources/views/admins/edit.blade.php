<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2
                    class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 dark:from-indigo-400 dark:via-blue-400 dark:to-cyan-300 bg-clip-text text-transparent tracking-tight">
                    Edit User
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Ubah data pengguna: <span
                        class="font-semibold text-gray-700 dark:text-gray-300">{{ $admin->name }}</span>
                </p>
            </div>
            <!-- Avatar besar sebagai hiasan -->
            <div class="hidden sm:block">
                <div
                    class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Card Form Premium -->
            <div
                class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl shadow-indigo-500/10 dark:shadow-indigo-900/30 border border-white/30 dark:border-gray-700/30 overflow-hidden">
                <!-- Dekorasi abstract -->
                <div
                    class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-gradient-to-br from-amber-400/20 to-transparent rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 right-0 -mb-10 -mr-10 w-40 h-40 bg-gradient-to-tl from-indigo-400/20 to-transparent rounded-full blur-3xl">
                </div>

                <div class="relative p-6 sm:p-10">
                    <form action="{{ route('admins.update', $admin) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div>
                            <label for="name"
                                class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}"
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm transition-all duration-300
                                       focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-400 focus:shadow-lg focus:shadow-indigo-500/10 @error('name') ring-2 ring-rose-500 border-rose-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="mt-2 flex items-center gap-1.5 text-xs text-rose-600 dark:text-rose-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Alamat Email
                            </label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $admin->email) }}"
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm transition-all duration-300
                                       focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-400 focus:shadow-lg focus:shadow-indigo-500/10 @error('email') ring-2 ring-rose-500 border-rose-500 @enderror"
                                placeholder="contoh@email.com">
                            @error('email')
                                <p class="mt-2 flex items-center gap-1.5 text-xs text-rose-600 dark:text-rose-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="password"
                                    class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Password Baru
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm transition-all duration-300
                                           focus:ring-2 focus:ring-amber-500/40 focus:border-amber-400 focus:shadow-lg focus:shadow-amber-500/10 @error('password') ring-2 ring-rose-500 border-rose-500 @enderror"
                                    placeholder="Minimal 8 karakter">
                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Kosongkan jika tidak ingin
                                    mengubah password</p>
                                @error('password')
                                    <p class="mt-2 flex items-center gap-1.5 text-xs text-rose-600 dark:text-rose-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Konfirmasi Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm transition-all duration-300
                                           focus:ring-2 focus:ring-amber-500/40 focus:border-amber-400 focus:shadow-lg focus:shadow-amber-500/10"
                                    placeholder="Ulangi password">
                            </div>
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role"
                                class="flex items-center gap-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Tipe Pengguna
                            </label>
                            <div class="relative">
                                <select name="role" id="role"
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm transition-all duration-300
                                           focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-400 focus:shadow-lg focus:shadow-indigo-500/10 appearance-none @error('role') ring-2 ring-rose-500 border-rose-500 @enderror">
                                    <option value="user" {{ old('role', $admin->role) == 'user' ? 'selected' : '' }}>
                                        👤 User Biasa</option>
                                    <option value="admin"
                                        {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>🛡️ Administrator
                                    </option>
                                </select>
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            @error('role')
                                <p class="mt-2 flex items-center gap-1.5 text-xs text-rose-600 dark:text-rose-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div
                            class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 border-t border-gray-200/60 dark:border-gray-700/40">
                            <a href="{{ route('admins.index') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-cyan-500 hover:from-indigo-700 hover:to-cyan-600 text-white font-bold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
