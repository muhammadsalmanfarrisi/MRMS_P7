<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2
                    class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 dark:from-indigo-400 dark:via-blue-400 dark:to-cyan-300 bg-clip-text text-transparent tracking-tight">
                    Manajemen Admin
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Kelola pengguna & hak akses sistem
                </p>
            </div>
            <!-- Statistik kecil opsional -->
            <div class="flex gap-3">
                <div
                    class="px-4 py-2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-md rounded-xl border border-amber-200/50 dark:border-amber-700/30 shadow-sm">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Admin</p>
                    <p class="text-xl font-bold text-amber-600 dark:text-amber-400">
                        {{ $users->where('role', 'admin')->count() }}</p>
                </div>

            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi Flash Premium -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="flex items-center p-5 bg-gradient-to-r from-emerald-50 to-emerald-100/80 dark:from-emerald-900/30 dark:to-emerald-900/20 backdrop-blur-md border border-emerald-300/60 dark:border-emerald-600/40 rounded-2xl shadow-lg shadow-emerald-500/10">
                    <div class="p-2 bg-emerald-200 dark:bg-emerald-700/50 rounded-full mr-4">
                        <svg class="w-6 h-6 text-emerald-700 dark:text-emerald-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200 flex-1">
                        {{ session('success') }}</p>
                    <button @click="show = false"
                        class="text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="flex items-center p-5 bg-gradient-to-r from-rose-50 to-rose-100/80 dark:from-rose-900/30 dark:to-rose-900/20 backdrop-blur-md border border-rose-300/60 dark:border-rose-600/40 rounded-2xl shadow-lg shadow-rose-500/10">
                    <div class="p-2 bg-rose-200 dark:bg-rose-700/50 rounded-full mr-4">
                        <svg class="w-6 h-6 text-rose-700 dark:text-rose-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-rose-800 dark:text-rose-200 flex-1">{{ session('error') }}</p>
                    <button @click="show = false"
                        class="text-rose-500 hover:text-rose-700 dark:hover:text-rose-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Card Utama -->
            <div
                class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl shadow-indigo-500/10 dark:shadow-indigo-900/30 border border-white/30 dark:border-gray-700/30 overflow-hidden">
                <!-- Dekorasi background abstract -->
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-gradient-to-bl from-amber-400/20 to-transparent rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-gradient-to-tr from-indigo-400/20 to-transparent rounded-full blur-3xl">
                </div>

                <div class="relative p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Daftar Pengguna
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total {{ $users->total() }}
                                pengguna terdaftar</p>
                        </div>
                        <a href="{{ route('admins.create') }}"
                            class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-cyan-500 hover:from-indigo-700 hover:to-cyan-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah User
                        </a>
                    </div>

                    <!-- Tabel Premium -->
                    <div
                        class="overflow-x-auto rounded-2xl border border-gray-200/60 dark:border-gray-700/60 shadow-inner">
                        <table class="min-w-full divide-y divide-gray-200/60 dark:divide-gray-700/60">
                            <thead>
                                <tr
                                    class="bg-gradient-to-r from-gray-50 to-gray-100/80 dark:from-gray-900/60 dark:to-gray-800/60 backdrop-blur-sm">
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Role</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-100 dark:divide-gray-700/40 bg-white/50 dark:bg-gray-800/50">
                                @forelse ($users as $user)
                                    <tr
                                        class="hover:bg-amber-50/50 dark:hover:bg-amber-900/10 transition-colors duration-200 group">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold text-sm shadow">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                        {{ $user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-5 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold
                                                {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 ring-1 ring-amber-300/70' : 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300 ring-1 ring-indigo-300/70' }}">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    @if ($user->role === 'admin')
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    @endif
                                                </svg>
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admins.edit', $user) }}"
                                                    class="relative group/tooltip p-2 rounded-xl text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-colors"
                                                    title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admins.destroy', $user) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Hapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="relative group/tooltip p-2 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors"
                                                        title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div
                                                    class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-700/50 flex items-center justify-center">
                                                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-500"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-500 dark:text-gray-400">Belum
                                                    ada pengguna terdaftar</p>
                                                <p class="text-sm text-gray-400 dark:text-gray-500">Klik tombol "Tambah
                                                    User" untuk memulai.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination indah -->
                    <div class="mt-8">
                        {{ $users->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
