<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Baris 1: Kotak Statistik Utama (4 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Total Tugas --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Tugas</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tugas Selesai --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Tugas Selesai</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $completedTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tugas Dalam Proses --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 mr-4">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Dalam Proses</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $inProgressTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mendekati Deadline --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Mendekati Deadline</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $approachingDeadline }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Baris 2: Statistik Tambahan & Material (3 kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Jumlah Karyawan --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 mr-4">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Karyawan</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalEmployees }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Material Dibutuhkan (Total Quantity) --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Material Dibutuhkan</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalMaterialQty }}
                                    Item</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Instruksi Belum Selesai --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-pink-100 dark:bg-pink-900 mr-4">
                                <svg class="w-6 h-6 text-pink-600 dark:text-pink-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Instruksi Pending</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $pendingInstructions }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Baris 3: Tabel Tugas Terbaru --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tugas Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Pelapor</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Alat Rusak</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Deadline</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($recentTasks as $task)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $task->reporter_name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->damaged_tool }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($task->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($recentTasks->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">Belum ada tugas.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
