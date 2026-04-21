<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/image.png') }}">

    <title>{{ config('app.name', 'MRMS_SP7') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const html = document.documentElement;

        toggleBtn.addEventListener('click', () => {
            html.classList.toggle('dark');
        });
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <img src="{{ asset('images/image.png') }}" alt="Logo"
                    class="w-40 h-40 dark:bg-white dark:p-2 dark:rounded-xl">
            </a>
        </div>
        <button id="theme-toggle"
            class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 dark:focus:ring-gray-500">
            <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:inline-block"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m8.66-9H21M3 12H2m15.36 6.36l.7.7M6.34 6.34l-.7-.7m12.02 0l.7-.7M6.34 17.66l-.7.7M12 8a4 4 0 100 8 4 4 0 000-8z" />
            </svg>
            <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:hidden" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
            </svg>
            <span class="text-sm font-medium">Toggle Mode</span>
        </button>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @if (session('success'))
                <div id="successMessage"
                    class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
                    <div class="max-w-sm w-full bg-green-100 shadow-lg rounded-lg pointer-events-auto mb-4">
                        <div class="rounded-lg shadow-xs overflow-hidden">
                            <div class="p-4 flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button id="closeSuccess"
                                        class="bg-green-100 rounded-md inline-flex text-green-500 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.293 5.293a1 1 0 00-1.414 1.414L10 10.414l-2.879 2.879a1 1 0 101.414 1.414L11.414 11l2.879 2.879a1 1 0 001.414-1.414L12.414 9l2.879-2.879a1 1 0 000-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div id="warningMessage"
                    class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
                    <div class="max-w-sm w-full bg-yellow-100 shadow-lg rounded-lg pointer-events-auto mb-4">
                        <div class="rounded-lg shadow-xs overflow-hidden">
                            <div class="p-4 flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1 8h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-yellow-800">{{ session('warning') }}</p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button id="closeWarning"
                                        class="bg-yellow-100 rounded-md inline-flex text-yellow-500 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.293 5.293a1 1 0 00-1.414 1.414L10 10.414l-2.879 2.879a1 1 0 101.414 1.414L11.414 11l2.879 2.879a1 1 0 001.414-1.414L12.414 9l2.879-2.879a1 1 0 000-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div id="errorMessage"
                    class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
                    <div class="max-w-sm w-full bg-red-100 shadow-lg rounded-lg pointer-events-auto mb-4">
                        <div class="rounded-lg shadow-xs overflow-hidden">
                            <div class="p-4 flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button id="closeError"
                                        class="bg-red-100 rounded-md inline-flex text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.293 5.293a1 1 0 00-1.414 1.414L10 10.414l-2.879 2.879a1 1 0 101.414 1.414L11.414 11l2.879 2.879a1 1 0 001.414-1.414L12.414 9l2.879-2.879a1 1 0 000-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
    <script>
        // Flash message auto close
        $('#closeSuccess').click(function() {
            $('#successMessage').fadeOut();
        });
        $('#closeWarning').click(function() {
            $('#warningMessage').fadeOut();
        });
        $('#closeError').click(function() {
            $('#errorMessage').fadeOut();
        });

        // Theme toggle functionality
        $('#theme-toggle').click(function() {
            $('body').toggleClass('dark');
            localStorage.setItem('theme', $('body').hasClass('dark') ? 'dark' : 'light');
        });

        // Set initial theme based on local storage
        $(document).ready(function() {
            if (localStorage.getItem('theme') === 'dark') {
                $('body').addClass('dark');
            }
        });
    </script>
</body>

</html>
