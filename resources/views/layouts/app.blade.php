<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-500">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Spindo - Solusi Manajemen Stok Premium & Eksklusif">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>{{ config('app.name', 'Spindo') }} | Manajemen Stok Premium</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Font Premium --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons (tetap digunakan karena ringan dan lengkap) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- jQuery & Select2 (untuk dropdown pencarian) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- QR Code scanner --}}
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ========== PARTIKEL BACKGROUND PREMIUM ========== */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle at 20% 30%, rgba(251, 191, 36, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 80% 70%, rgba(217, 119, 6, 0.03) 0%, transparent 35%),
                radial-gradient(circle at 40% 80%, rgba(245, 158, 11, 0.02) 0%, transparent 40%);
            animation: subtleShift 20s infinite alternate ease-in-out;
        }

        @keyframes subtleShift {
            0% {
                opacity: 0.6;
                transform: scale(1);
            }

            100% {
                opacity: 1;
                transform: scale(1.05);
            }
        }

        /* ========== SELECT2 STYLING PREMIUM EMAS ========== */
        .select2-container--classic .select2-selection--single {
            background: rgba(255, 255, 255, 0.6) !important;
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(251, 191, 36, 0.25) !important;
            border-radius: 1rem !important;
            height: 48px !important;
            padding: 6px 16px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .dark .select2-container--classic .select2-selection--single {
            background: rgba(17, 24, 39, 0.7) !important;
            border-color: rgba(251, 191, 36, 0.3) !important;
            color: #f3f4f6 !important;
        }

        .select2-container--classic .select2-selection--single:focus,
        .select2-container--classic .select2-selection--single:hover {
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15), 0 4px 12px rgba(0, 0, 0, 0.05) !important;
        }

        .select2-dropdown--classic {
            border-radius: 1rem !important;
            border: 1px solid rgba(251, 191, 36, 0.3) !important;
            box-shadow: 0 20px 30px -8px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(251, 191, 36, 0.1) !important;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.9) !important;
            overflow: hidden;
        }

        .dark .select2-dropdown--classic {
            background: rgba(31, 41, 55, 0.9) !important;
            border-color: rgba(251, 191, 36, 0.4) !important;
        }

        .select2-container--classic .select2-results__option--highlighted {
            background: linear-gradient(135deg, #fbbf24, #d97706) !important;
            color: white !important;
        }

        /* ========== SCROLLBAR PREMIUM EMAS ========== */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(241, 241, 241, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(145deg, #d4af37, #b8860b);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(145deg, #e6c44d, #c99c1c);
        }

        .dark ::-webkit-scrollbar-track {
            background: rgba(45, 45, 45, 0.5);
        }

        .dark ::-webkit-scrollbar-thumb {
            background: linear-gradient(145deg, #a67c00, #7a5c00);
            border-color: rgba(0, 0, 0, 0.3);
        }

        /* ========== TOAST NOTIFIKASI MEWAH ========== */
        .toast-premium {
            animation: slideInRight 0.4s cubic-bezier(0.2, 0.9, 0.4, 1), fadeOut 0.8s ease-in 4.2s forwards;
            backdrop-filter: blur(12px);
            border-width: 0 0 0 6px;
            border-style: solid;
            border-image: linear-gradient(135deg, #fbbf24, #b45309) 1;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(251, 191, 36, 0.2);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(120%) scale(0.95);
                opacity: 0;
            }

            to {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                visibility: hidden;
                transform: translateY(8px);
            }
        }

        /* ========== GLASS HEADER PREMIUM ========== */
        .glass-header-premium {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px) saturate(180%);
            border-bottom: 1px solid rgba(251, 191, 36, 0.3);
            box-shadow: 0 4px 20px -6px rgba(0, 0, 0, 0.05);
        }

        .dark .glass-header-premium {
            background: rgba(15, 23, 42, 0.8);
            border-bottom: 1px solid rgba(251, 191, 36, 0.2);
            box-shadow: 0 4px 20px -6px rgba(0, 0, 0, 0.3);
        }

        /* ========== TOMBOL THEME TOGGLE MEWAH ========== */
        .theme-toggle-premium {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(251, 191, 36, 0.3);
            border-radius: 2.5rem;
            padding: 0.5rem 1.25rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .theme-toggle-premium:hover {
            background: rgba(251, 191, 36, 0.1);
            border-color: #fbbf24;
            box-shadow: 0 8px 18px -6px rgba(245, 158, 11, 0.2);
            transform: translateY(-1px);
        }

        .dark .theme-toggle-premium {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(251, 191, 36, 0.25);
        }

        /* ========== GRADASI TEKS JUDUL HEADER ========== */
        .text-gold-gradient {
            background: linear-gradient(135deg, #b8860b 0%, #fbbf24 40%, #f59e0b 80%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .dark .text-gold-gradient {
            background: linear-gradient(135deg, #fbbf24 0%, #fcd34d 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-gradient-to-br from-stone-50 via-amber-50/20 to-stone-100 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200 transition-all duration-500">

    <div class="min-h-screen flex flex-col">
        {{-- Navigasi Premium (sudah dibuat sebelumnya) --}}
        @include('layouts.navigation')

        {{-- Header dengan Judul Halaman & Tombol Mode Premium --}}
        @isset($header)
            <header class="glass-header-premium sticky top-0 z-30">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gold-gradient tracking-tight">
                        {{ $header }}
                    </h1>

                    {{-- Tombol Dark/Light Mode Mewah --}}
                    <button id="theme-toggle"
                        class="theme-toggle-premium group flex items-center gap-3 focus:outline-none focus:ring-2 focus:ring-amber-400/70 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        {{-- Ikon Matahari (Light Mode) --}}
                        <div class="relative w-5 h-5">
                            <i
                                class="bi bi-brightness-high-fill absolute inset-0 text-amber-500 text-xl transition-all duration-500 transform dark:opacity-0 dark:rotate-90 opacity-100 rotate-0"></i>
                            <i
                                class="bi bi-moon-stars-fill absolute inset-0 text-amber-300 dark:text-amber-200 text-xl transition-all duration-500 transform opacity-0 -rotate-90 dark:opacity-100 dark:rotate-0"></i>
                        </div>
                        <span
                            class="text-sm font-medium tracking-wide text-gray-700 dark:text-gray-200 group-hover:text-amber-800 dark:group-hover:text-amber-200 transition-colors">
                            {{ __('Tema') }}
                        </span>
                    </button>
                </div>
            </header>
        @endisset

        {{-- Flash Messages Premium (Toast) --}}
        @if (session('success'))
            <div id="flashSuccess"
                class="fixed bottom-6 right-6 z-50 toast-premium max-w-sm w-full bg-emerald-50/80 dark:bg-emerald-900/70 border-l-8 border-emerald-500 rounded-2xl shadow-2xl">
                <div class="p-4 flex items-start gap-3">
                    <div class="shrink-0 bg-emerald-100 dark:bg-emerald-800/50 rounded-full p-1.5">
                        <i class="bi bi-check-circle-fill text-emerald-600 dark:text-emerald-300 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200">{{ session('success') }}
                        </p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="shrink-0 text-emerald-500 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-200 transition-colors p-1 rounded-full hover:bg-emerald-200/30 dark:hover:bg-emerald-800/30">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div id="flashWarning"
                class="fixed bottom-6 right-6 z-50 toast-premium max-w-sm w-full bg-amber-50/80 dark:bg-amber-900/70 border-l-8 border-amber-500 rounded-2xl shadow-2xl">
                <div class="p-4 flex items-start gap-3">
                    <div class="shrink-0 bg-amber-100 dark:bg-amber-800/50 rounded-full p-1.5">
                        <i class="bi bi-exclamation-triangle-fill text-amber-600 dark:text-amber-300 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-amber-800 dark:text-amber-200">{{ session('warning') }}</p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="shrink-0 text-amber-500 hover:text-amber-700 dark:text-amber-400 dark:hover:text-amber-200 transition-colors p-1 rounded-full hover:bg-amber-200/30 dark:hover:bg-amber-800/30">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="flashError"
                class="fixed bottom-6 right-6 z-50 toast-premium max-w-sm w-full bg-rose-50/80 dark:bg-rose-900/70 border-l-8 border-rose-500 rounded-2xl shadow-2xl">
                <div class="p-4 flex items-start gap-3">
                    <div class="shrink-0 bg-rose-100 dark:bg-rose-800/50 rounded-full p-1.5">
                        <i class="bi bi-x-octagon-fill text-rose-600 dark:text-rose-300 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-rose-800 dark:text-rose-200">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.closest('[id^=flash]')?.remove()"
                        class="shrink-0 text-rose-500 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-200 transition-colors p-1 rounded-full hover:bg-rose-200/30 dark:hover:bg-rose-800/30">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Konten Utama --}}
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>

        {{-- Footer opsional (bisa ditambahkan sesuai kebutuhan) --}}
        <div
            class="mt-auto py-6 text-center text-xs text-gray-400 dark:text-gray-500 border-t border-amber-200/30 dark:border-amber-800/20 backdrop-blur-sm">
            <span class="tracking-wider uppercase">{{ config('app.name', 'Spindo') }} &copy; {{ date('Y') }} —
                MAINTENANCE REPORTING MANAGEMENT SYSTEM SPINDO PLANT 7</span>
        </div>
    </div>

    <script>
        // ========== DARK MODE TOGGLE DENGAN ANIMASI HALUS ==========
        (function() {
            const themeToggle = document.getElementById('theme-toggle');
            const root = document.documentElement;

            function setTheme(isDark) {
                if (isDark) {
                    root.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    root.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }

            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                setTheme(true);
            } else {
                setTheme(false);
            }

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const isDarkNow = root.classList.contains('dark');
                    setTheme(!isDarkNow);
                });
            }
        })();

        // ========== AUTO CLOSE FLASH MESSAGES ==========
        document.querySelectorAll('[id^="flash"]').forEach(el => {
            setTimeout(() => {
                if (el && el.remove) {
                    el.style.transition = 'opacity 0.4s, transform 0.4s';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(10px)';
                    setTimeout(() => el.remove(), 400);
                }
            }, 4800); // sedikit lebih lama karena animasi fadeOut di CSS
        });

        // ========== INISIALISASI SELECT2 GLOBAL (dengan sentuhan premium) ==========
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $ !== 'undefined' && $.fn.select2) {
                // Inisialisasi semua select dengan class select2
                $('.select2').each(function() {
                    $(this).select2({
                        theme: 'classic',
                        width: '100%',
                        placeholder: $(this).data('placeholder') || 'Pilih...',
                        allowClear: true,
                        dropdownCssClass: 'rounded-xl shadow-2xl border-amber-200/30',
                        containerCssClass: 'rounded-xl border-2 border-amber-200/50 dark:border-amber-700/30 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm'
                    });
                });
            }

            // SkillSelect khusus jika ada
            if (typeof $ !== 'undefined' && $('#skillSelect').length) {
                $('#skillSelect').select2({
                    theme: 'classic',
                    width: '100%',
                    placeholder: 'Pilih keahlian',
                    allowClear: true,
                    dropdownCssClass: 'rounded-xl shadow-2xl border-amber-200/30',
                    containerCssClass: 'rounded-xl border-2 border-amber-200/50 dark:border-amber-700/30 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm'
                });
            }
        });
    </script>

    <!-- Flatpickr CSS & JS (wajib)
        -->

    @stack('scripts')


</body>

</html>
