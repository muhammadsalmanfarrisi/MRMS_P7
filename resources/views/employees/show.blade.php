<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 opacity-90"></div>
            <div class="relative px-6 py-6 md:px-8 md:py-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-white/20 backdrop-blur rounded-xl">
                            <i class="bi bi-person-badge text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-white">Detail Tugas Pekerja</h2>
                            <p class="text-white/80 text-sm">{{ $employee->name }} · {{ $employee->skill }}</p>
                        </div>
                    </div>
                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 bg-white/20 backdrop-blur rounded-xl text-white hover:bg-white/30 transition">
                        <i class="bi bi-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="bi bi-list-check text-indigo-500"></i> Seluruh Tugas ({{ $employee->tasks->count() }})
                </h3>

                @if ($employee->tasks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Alat Yang Diperbaiki</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Dibuat Pada</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Terakhir Update</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($employee->tasks as $task)
                                    <tr class="hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition">
                                        <td class="px-4 py-3">{{ $task->damaged_tool }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusColor = match ($task->status) {
                                                    'pending'
                                                        => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
                                                    'in_progress'
                                                        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                                    'completed'
                                                        => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                            @endphp
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $task->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-3">{{ $task->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <i class="bi bi-inbox text-5xl"></i>
                        <p class="mt-2">Belum ada tugas yang dikerjakan oleh pekerja ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
