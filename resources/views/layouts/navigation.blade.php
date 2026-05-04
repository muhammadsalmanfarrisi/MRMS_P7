<nav x-data="{ open: false }"
    class="sticky top-0 z-40 bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl border-b border-amber-200/40 dark:border-amber-700/30 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.08)] dark:shadow-[0_4px_20px_-8px_rgba(0,0,0,0.4)]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <div class="flex items-center gap-8 lg:gap-12">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div
                            class="p-0.5 rounded-full bg-gradient-to-tr from-indigo-500 to-cyan-400 shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform duration-300 ease-out">
                            <div class="bg-white dark:bg-gray-800 rounded-full p-1">
                                <img src="{{ asset('images/image.png') }}" alt="Logo"
                                    class="w-9 h-9 object-contain">
                            </div>
                        </div>

                        <span
                            class="font-extrabold text-xl tracking-widest uppercase bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-400 dark:from-indigo-400 dark:via-blue-300 dark:to-cyan-300 bg-clip-text text-transparent drop-shadow-sm group-hover:from-cyan-400 group-hover:to-indigo-600 transition-all duration-500">
                            MRMS_SP7
                        </span>
                    </a>
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden sm:flex items-center space-x-1">
                    {{-- Dashboard Link --}}
                    <a href="{{ route('dashboard') }}"
                        class="group relative flex items-center gap-1.5 px-5 py-2 text-base font-semibold tracking-wide transition-all duration-300
          text-gray-800 dark:text-gray-100 hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('dashboard') ? '!text-amber-700 dark:!text-amber-300' : '' }}">
                        <!-- Ikon: Dashboard -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span
                            class="relative inline-block
               before:absolute before:bottom-0 before:left-1/2 before:w-0 before:h-0.5 
               before:bg-gradient-to-r before:from-amber-400 before:to-amber-600 
               before:shadow-[0_0_8px_rgba(251,191,36,0.6)]
               before:transition-all before:duration-300 before:ease-out
               group-hover:before:w-full group-hover:before:left-0
               {{ request()->routeIs('dashboard') ? 'before:!w-full before:!left-0' : '' }}">
                            {{ __('Dashboard') }}
                        </span>
                    </a>

                    <a href="{{ route('reports.index') }}"
                        class="group relative flex items-center gap-1.5 px-5 py-2 text-base font-semibold tracking-wide transition-all duration-300
          text-gray-800 dark:text-gray-100 hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('reports.index') ? '!text-amber-700 dark:!text-amber-300' : '' }}">
                        <!-- Ikon: Laporan (Document Text) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <span
                            class="relative inline-block
               before:absolute before:bottom-0 before:left-1/2 before:w-0 before:h-0.5 
               before:bg-gradient-to-r before:from-amber-400 before:to-amber-600 
               before:shadow-[0_0_8px_rgba(251,191,36,0.6)]
               before:transition-all before:duration-300 before:ease-out
               group-hover:before:w-full group-hover:before:left-0
               {{ request()->routeIs('reports.index') ? 'before:!w-full before:!left-0' : '' }}">
                            {{ __('Reports') }}
                        </span>
                    </a>

                    <a href="{{ route('tasks.index') }}"
                        class="group relative flex items-center gap-1.5 px-5 py-2 text-base font-semibold tracking-wide transition-all duration-300
          text-gray-800 dark:text-gray-100 hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('tasks.index') ? '!text-amber-700 dark:!text-amber-300' : '' }}">
                        <!-- Ikon: Tugas (Clipboard List) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.802 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.802 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        <span
                            class="relative inline-block
               before:absolute before:bottom-0 before:left-1/2 before:w-0 before:h-0.5 
               before:bg-gradient-to-r before:from-amber-400 before:to-amber-600 
               before:shadow-[0_0_8px_rgba(251,191,36,0.6)]
               before:transition-all before:duration-300 before:ease-out
               group-hover:before:w-full group-hover:before:left-0
               {{ request()->routeIs('tasks.index') ? 'before:!w-full before:!left-0' : '' }}">
                            {{ __('Tasks') }}
                        </span>
                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="group relative flex items-center gap-1.5 px-5 py-2 text-base font-semibold tracking-wide transition-all duration-300
          text-gray-800 dark:text-gray-100 hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('employees.index') ? '!text-amber-700 dark:!text-amber-300' : '' }}">
                        <!-- Ikon: Karyawan (Users) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span
                            class="relative inline-block
               before:absolute before:bottom-0 before:left-1/2 before:w-0 before:h-0.5 
               before:bg-gradient-to-r before:from-amber-400 before:to-amber-600 
               before:shadow-[0_0_8px_rgba(251,191,36,0.6)]
               before:transition-all before:duration-300 before:ease-out
               group-hover:before:w-full group-hover:before:left-0
               {{ request()->routeIs('employees.index') ? 'before:!w-full before:!left-0' : '' }}">
                            {{ __('Employees') }}
                        </span>
                    </a>


                    {{-- Contoh link tambahan: Bon Permintaan --}}
                    {{-- 
                    <a href="{{ route('requests.index') }}" 
                       class="group relative px-5 py-2 text-base font-semibold ...">
                        <span class="relative inline-block ...">
                            {{ __('Bon Permintaan') }}
                        </span>
                    </a>
                    --}}
                </div>
            </div>

            {{-- Profil Dropdown Desktop --}}
            <div class="hidden sm:flex items-center gap-3">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button
                            class="group flex items-center gap-3 px-4 py-2.5 rounded-full 
                                       bg-gradient-to-r from-amber-50/80 to-white/80 dark:from-amber-900/30 dark:to-gray-800/80
                                       backdrop-blur-sm border border-amber-300/50 dark:border-amber-600/30 
                                       shadow-sm hover:shadow-lg transition-all duration-300
                                       focus:outline-none focus:ring-2 focus:ring-amber-400/70">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 
                                        flex items-center justify-center text-white font-bold text-sm shadow-inner">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 tracking-wide">
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 transition-transform duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div
                            class="rounded-2xl overflow-hidden border border-amber-200/30 dark:border-amber-700/30 
                                    bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl shadow-2xl p-2">
                            <div class="px-4 py-3 border-b border-amber-100/50 dark:border-amber-800/50">
                                <p class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}
                                </p>
                            </div>
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium
                                      text-gray-700 dark:text-gray-200 hover:bg-amber-50 dark:hover:bg-amber-900/30 
                                      hover:text-amber-700 dark:hover:text-amber-300 transition-colors">
                                <i class="bi bi-person-circle text-amber-500 text-lg"></i>
                                {{ __('Profil Saya') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium
                                          text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 
                                          hover:text-rose-700 dark:hover:text-rose-300 transition-colors">
                                    <i class="bi bi-box-arrow-right text-rose-500 text-lg"></i>
                                    {{ __('Keluar') }}
                                </a>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger Mobile --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="p-3 rounded-xl text-gray-700 dark:text-gray-200 
                               hover:bg-amber-50 dark:hover:bg-amber-900/30 
                               hover:text-amber-700 dark:hover:text-amber-300
                               focus:outline-none focus:ring-2 focus:ring-amber-400/70 transition-all">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'block': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'block': open, 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden absolute top-20 left-4 right-4 z-50 rounded-3xl 
                bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl 
                border border-amber-200/40 dark:border-amber-700/30 shadow-2xl overflow-hidden"
        style="display: none;">

        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
                class="block px-5 py-4 rounded-2xl text-base font-semibold transition-all
          text-gray-800 dark:text-gray-100 hover:bg-amber-50 dark:hover:bg-amber-900/30 
          hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('dashboard') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300' : '' }}">
                <i class="bi bi-speedometer2 mr-3 text-amber-500"></i> {{ __('Dashboard') }}
            </a>

            <a href="{{ route('reports.index') }}"
                class="block px-5 py-4 rounded-2xl text-base font-semibold transition-all
          text-gray-800 dark:text-gray-100 hover:bg-amber-50 dark:hover:bg-amber-900/30 
          hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('reports.index') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300' : '' }}">
                <i class="bi bi-file-earmark-bar-graph mr-3 text-amber-500"></i> {{ __('Reports') }}
            </a>

            <a href="{{ route('tasks.index') }}"
                class="block px-5 py-4 rounded-2xl text-base font-semibold transition-all
          text-gray-800 dark:text-gray-100 hover:bg-amber-50 dark:hover:bg-amber-900/30 
          hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('tasks.index') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300' : '' }}">
                <i class="bi bi-list-check mr-3 text-amber-500"></i> {{ __('Tasks') }}
            </a>

            <a href="{{ route('employees.index') }}"
                class="block px-5 py-4 rounded-2xl text-base font-semibold transition-all
          text-gray-800 dark:text-gray-100 hover:bg-amber-50 dark:hover:bg-amber-900/30 
          hover:text-amber-700 dark:hover:text-amber-300
          {{ request()->routeIs('employees.index') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300' : '' }}">
                <i class="bi bi-people-fill mr-3 text-amber-500"></i> {{ __('Employees') }}
            </a>
        </div>

        <div class="border-t border-amber-200/30 dark:border-amber-700/30 p-4">
            <div class="px-3 py-2">
                <p class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
            <div class="mt-2 space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-5 py-4 rounded-2xl text-base font-medium
                          text-gray-700 dark:text-gray-200 hover:bg-amber-50 dark:hover:bg-amber-900/30 
                          hover:text-amber-700 dark:hover:text-amber-300 transition-all">
                    <i class="bi bi-person-circle text-amber-500 text-lg mr-3"></i>
                    {{ __('Profil Saya') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center px-5 py-4 rounded-2xl text-base font-medium
                              text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 
                              hover:text-rose-700 dark:hover:text-rose-300 transition-all">
                        <i class="bi bi-box-arrow-right text-rose-500 text-lg mr-3"></i>
                        {{ __('Keluar') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
