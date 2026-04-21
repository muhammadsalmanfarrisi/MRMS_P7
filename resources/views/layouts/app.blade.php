<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Aman Plastik - Manajemen Stok Modern & Cepat">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'Aman Plastik') }} - Manajemen Stok Premium</title>

    {{-- Fonts & Preconnect --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons (lebih ringan dari Font Awesome) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- jQuery & Select2 (untuk dropdown pencarian) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- QR Code scanner --}}
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    {{-- Vite (CSS/JS milik Laravel) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Select2 premium styling */
        .select2-container--classic .select2-selection--single {
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            height: 48px;
            padding: 6px 12px;
            transition: all 0.3s;
        }

        .dark .select2-container--classic .select2-selection--single {
            background: rgba(17, 24, 39, 0.5);
            border-color: #374151;
            color: #f3f4f6;
        }

        .select2-container--classic .select2-selection--single:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2);
        }

        .select2-dropdown--classic {
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .dark .select2-dropdown--classic {
            background: #1f2937;
            border-color: #4b5563;
        }

        .select2-container--classic .select2-results__option--highlighted {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        /* Custom scrollbar & glassmorphism effect untuk header */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .dark ::-webkit-scrollbar-track {
            background: #2d2d2d;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #555;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dark .glass-header {
            background: rgba(17, 24, 39, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .toast-message {
            animation: slideInRight 0.3s ease-out, fadeOut 0.5s ease-in 4.5s forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200 transition-all duration-300">

    <div class="min-h-screen">
        {{-- Navigasi Utama --}}
        @include('layouts.navigation')

        {{-- Header dengan Tombol Toggle Mode yang premium --}}
        @isset($header)
            <header class="glass-header sticky top-0 z-30 shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-4">
                    <div
                        class="text-xl font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                        {{ $header }}
                    </div>

                    {{-- Tombol Dark/Light Mode dengan efek hover --}}
                    <button id="theme-toggle"
                        class="group flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200 dark:border-gray-700 shadow-md hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i id="theme-icon-sun"
                            class="bi bi-brightness-high-fill text-yellow-500 text-lg block dark:hidden"></i>
                        <i id="theme-icon-moon" class="bi bi-moon-stars-fill text-indigo-300 text-lg hidden dark:block"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mode</span>
                    </button>
                </div>
            </header>
        @endisset

        {{-- Flash Messages (Toast) Premium --}}
        @if (session('success'))
            <div id="flashSuccess"
                class="fixed bottom-5 right-5 z-50 toast-message max-w-sm bg-emerald-50 dark:bg-emerald-900/80 border-l-8 border-emerald-500 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-4 flex items-start gap-3">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-xl"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200">{{ session('success') }}
                        </p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="text-emerald-600 hover:text-emerald-800 dark:text-emerald-300">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div id="flashWarning"
                class="fixed bottom-5 right-5 z-50 toast-message max-w-sm bg-amber-50 dark:bg-amber-900/80 border-l-8 border-amber-500 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-4 flex items-start gap-3">
                    <i class="bi bi-exclamation-triangle-fill text-amber-500 text-xl"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-amber-800 dark:text-amber-200">{{ session('warning') }}</p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="text-amber-600 hover:text-amber-800 dark:text-amber-300">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="flashError"
                class="fixed bottom-5 right-5 z-50 toast-message max-w-sm bg-red-50 dark:bg-red-900/80 border-l-8 border-red-500 rounded-xl shadow-2xl backdrop-blur-sm">
                <div class="p-4 flex items-start gap-3">
                    <i class="bi bi-x-octagon-fill text-red-500 text-xl"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="text-red-600 hover:text-red-800 dark:text-red-300">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
    </div>

    <script>
        // ========== DARK MODE TOGGLE ==========
        (function() {
            const themeToggle = document.getElementById('theme-toggle');
            const root = document.documentElement;

            // Fungsi set tema
            function setTheme(isDark) {
                if (isDark) {
                    root.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    root.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }

            // Inisialisasi tema dari localStorage / preferensi sistem
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                setTheme(true);
            } else {
                setTheme(false);
            }

            // Event listener toggle
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const isDarkNow = root.classList.contains('dark');
                    setTheme(!isDarkNow);
                });
            }
        })();

        // ========== AUTO CLOSE FLASH MESSAGES (opsional, sudah ada CSS animation) ==========
        document.querySelectorAll('[id^="flash"]').forEach(el => {
            setTimeout(() => {
                if (el && el.remove) el.remove();
            }, 5000);
        });

        // ========== INISIALISASI SELECT2 (jika ada elemen .select2) ==========
        // Biasanya dipanggil di halaman yang butuh, tapi kita siapkan saja
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('.select2').select2({
                    theme: 'classic',
                    width: 'resolve'
                });
            }
        });

        $(document).ready(function() {
            $('#skillSelect').select2({
                theme: 'classic',
                width: '100%',
                placeholder: 'Pilih keahlian',
                allowClear: true,
                dropdownCssClass: 'rounded-xl shadow-lg',
                containerCssClass: 'rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50'
            });
        });
    </script>
</body>

</html>
