<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Baris 1: Statistik Ringkas (3 kolom) --}}
            {{-- Baris 1: Statistik Ringkas (4 kolom) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Total Tugas Hari Ini --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Tugas Hari Ini</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Pekerja --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 mr-4">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Pekerja Manufaktur</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalEmployees }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overdue / Terlambat --}}
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-700 dark:text-red-300 text-sm font-medium">⚠️ Terlambat</p>
                                <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $overdueTasks }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Deadline lewat & belum selesai
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mendekati Deadline --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-900 mr-4">
                                <svg class="w-6 h-6 text-amber-600 dark:text-amber-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Mendekati Deadline</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">(3 hari ke depan)</p>
                                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">
                                    {{ $approachingDeadline }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Baris 2: Status Progres Pekerjaan (4 kolom) --}}
            {{-- Baris 2: Status Progres Pekerjaan (4 kolom) dengan background warna --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Pelaporan Belum Diproses (Merah) --}}
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-200 dark:bg-red-800 mr-4">
                                <svg class="w-6 h-6 text-red-700 dark:text-red-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-800 dark:text-red-200 text-sm font-medium">Pelaporan Belum Diproses
                                </p>
                                <p class="text-2xl font-bold text-red-900 dark:text-red-100">{{ $unprocessedTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dalam Proses (Kuning) --}}
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-200 dark:bg-yellow-800 mr-4">
                                <svg class="w-6 h-6 text-yellow-700 dark:text-yellow-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-yellow-800 dark:text-yellow-200 text-sm font-medium">Dalam Proses</p>
                                <p class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">
                                    {{ $inProgressTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sedang Dikerjakan (Biru) --}}
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-200 dark:bg-blue-800 mr-4">
                                <svg class="w-6 h-6 text-blue-700 dark:text-blue-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-800 dark:text-blue-200 text-sm font-medium">Sedang Dikerjakan</p>
                                <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $workedOnTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Selesai Dikerjakan (Hijau) --}}
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-200 dark:bg-green-800 mr-4">
                                <svg class="w-6 h-6 text-green-700 dark:text-green-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-green-800 dark:text-green-200 text-sm font-medium">Selesai Dikerjakan
                                </p>
                                <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ $completedTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Baris 3: Notifikasi Real-Time --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            Aktivitas Terkini
                            <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">(real-time)</span>
                        </h3>
                        <button id="refreshTable"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all"
                            title="Refresh Data">
                            <i class="bi bi-arrow-repeat text-lg"></i>
                        </button>
                    </div>

                    {{-- Daftar Notifikasi --}}
                    <div id="notification-list" class="space-y-2 max-h-96 overflow-y-auto">
                        @if (isset($recentActivities) && count($recentActivities) > 0)
                            @foreach ($recentActivities as $activity)
                                @php
                                    $colorMap = [
                                        'unprocessed' => 'red',
                                        'processed' => 'yellow',
                                        'worked_on' => 'blue',
                                        'finished' => 'green',
                                    ];
                                    $color = $colorMap[$activity['status']] ?? 'gray';
                                @endphp
                                <div
                                    class="p-3 border-l-4 border-{{ $color }}-500 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 rounded-r-lg flex items-start space-x-3 animate-fade-in">
                                    <div class="flex-shrink-0 mt-1">
                                        @if ($activity['action'] === 'created')
                                            <svg class="w-4 h-4 text-{{ $color }}-600 dark:text-{{ $color }}-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-{{ $color }}-600 dark:text-{{ $color }}-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-black">
                                            @if ($activity['action'] === 'created')
                                                <span class="font-semibold">{{ $activity['reporter_name'] }}</span>
                                                melaporkan kerusakan
                                                <span class="font-semibold">"{{ $activity['damaged_tool'] }}"</span>
                                            @else
                                                Status tugas <span
                                                    class="font-semibold">"{{ $activity['damaged_tool'] }}"</span>
                                                diubah menjadi
                                                <span
                                                    class="font-semibold text-{{ $color }}-700 dark:text-{{ $color }}-300">
                                                    {{ ucfirst(str_replace('_', ' ', $activity['status'])) }}
                                                </span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ \Carbon\Carbon::parse($activity['time'])->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4" id="no-notif">Belum ada
                                aktivitas.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    window.Echo.channel('tasks')
                        .listen('.task.activity', (data) => {
                            addNotification(data);
                        });
                }

                function addNotification(data) {
                    const container = document.getElementById('notification-list');
                    const noNotif = document.getElementById('no-notif');
                    if (noNotif) noNotif.remove();

                    const colorMap = {
                        'unprocessed': 'red',
                        'processed': 'yellow',
                        'worked_on': 'blue',
                        'finished': 'green'
                    };
                    const color = colorMap[data.status] || 'gray';

                    const icon = data.action === 'created' ?
                        `<svg class="w-4 h-4 text-${color}-600 dark:text-${color}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>` :
                        `<svg class="w-4 h-4 text-${color}-600 dark:text-${color}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>`;

                    let message = '';
                    if (data.action === 'created') {
                        message =
                            `<span class="font-semibold">${data.reporter_name}</span> melaporkan kerusakan <span class="font-semibold">"${data.damaged_tool}"</span>`;
                    } else {
                        const statusText = data.status.replace('_', ' ');
                        message =
                            `Status tugas <span class="font-semibold">"${data.damaged_tool}"</span> diubah menjadi <span class="font-semibold text-${color}-700">${statusText.charAt(0).toUpperCase() + statusText.slice(1)}</span>`;
                    }

                    const timeAgo = moment(data.time).fromNow();

                    const item = document.createElement('div');
                    item.className =
                        `p-3 border-l-4 border-${color}-500 bg-${color}-50 dark:bg-${color}-900/20 rounded-r-lg flex items-start space-x-3 animate-fade-in`;
                    item.innerHTML = `
                <div class="flex-shrink-0 mt-1">${icon}</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${message}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${timeAgo}</p>
                </div>
            `;

                    container.prepend(item);

                    // Batasi jumlah notifikasi maksimal 20
                    if (container.children.length > 20) {
                        container.removeChild(container.lastChild);
                    }
                }
                // === TAMBAHKAN SCRIPT REFRESH DI SINI ===
                const refreshBtn = document.getElementById('refreshTable');
                if (refreshBtn) {
                    refreshBtn.addEventListener('click', function() {
                        location.reload();
                    });
                }
            });
        </script>
    @endpush


    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

</x-app-layout>
