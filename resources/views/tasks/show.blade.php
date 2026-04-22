<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 opacity-90 dark:opacity-95">
            </div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff"
                fill-opacity="0.08"%3E%3Cpath
                d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

            <div class="relative px-6 py-6 md:px-8 md:py-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-white/20 backdrop-blur rounded-xl shadow-lg">
                                <i class="bi bi-eye-fill text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                                {{ __('Detail Pekerjaan') }}
                            </h2>
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold text-white border border-white/30">
                                <i class="bi bi-info-circle mr-1"></i> #{{ $task->damaged_tool }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-3 text-white/90 text-sm">
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-calendar"></i>
                                <span>Dibuat: {{ $task->created_at->translatedFormat('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 bg-white text-amber-700 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-amber-100 to-yellow-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <i class="bi bi-pencil-square text-lg relative z-10"></i>
                            <span class="relative z-10">Edit Pekerjaan</span>
                        </a>
                        <a href="{{ route('tasks.index') }}"
                            class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 bg-white/80 backdrop-blur text-gray-700 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class="bi bi-arrow-left text-lg"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        {{-- Informasi Utama --}}
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="bi bi-wrench-adjustable text-cyan-600"></i> Informasi Pekerjaan
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Alat / Mesin
                            Rusak</label>
                        <p class="text-base font-semibold text-gray-800 dark:text-white">
                            {{ $task->damaged_tool ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Penyebab
                            Kerusakan</label>
                        <p class="text-gray-700 dark:text-gray-300">{{ $task->cause ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Deskripsi
                            Pekerjaan</label>
                        <p class="text-gray-700 dark:text-gray-300">{{ $task->description ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                        @php
                            $statusMap = [
                                'unprocessed' => [
                                    'label' => 'Belum di Proses',
                                    'color' => 'bg-gray-100 text-gray-800 border-gray-300',
                                ],
                                'processed' => [
                                    'label' => 'Sedang di Proses',
                                    'color' => 'bg-blue-100 text-blue-800 border-blue-200',
                                ],
                                'finished' => [
                                    'label' => 'Selesai',
                                    'color' => 'bg-green-100 text-green-800 border-green-200',
                                ],
                                'worked_on' => [
                                    'label' => 'Sedang Dikerjakan',
                                    'color' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                ],
                            ];
                            $status = $statusMap[$task->status] ?? [
                                'label' => ucfirst($task->status),
                                'color' => 'bg-gray-100 text-gray-800 border-gray-300',
                            ];
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $status['color'] }}">
                            <i class="bi bi-circle-fill mr-1 text-[8px]"></i> {{ $status['label'] }}
                        </span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Waktu
                            Eksekusi</label>
                        <p class="text-gray-700 dark:text-gray-300 flex items-center gap-1">
                            <i class="bi bi-calendar3 text-gray-400"></i>
                            {{ $task->execution_time ? \Carbon\Carbon::parse($task->execution_time)->translatedFormat('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Deadline</label>
                        <p class="text-gray-700 dark:text-gray-300 flex items-center gap-1">
                            <i class="bi bi-hourglass-split text-gray-400"></i>
                            {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">PIC /
                            Mekanik</label>
                        @if ($task->employees->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($task->employees as $emp)
                                    <span
                                        class="inline-flex items-center gap-1 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-300 text-sm px-3 py-1.5 rounded-lg">
                                        <i class="bi bi-person-circle"></i> {{ $emp->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-400 italic">Belum ditugaskan</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Instruksi
                            Khusus</label>
                        <p class="text-gray-700 dark:text-gray-300">{{ $task->instructions ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($task->detail_instructions && $task->detail_instructions->count() > 0)
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <i class="bi bi-list-check text-green-600"></i> Langkah Pengerjaan
                    </h3>
                </div>
                <div class="p-6">
                    <ol class="space-y-3 list-decimal list-inside">
                        @foreach ($task->detail_instructions as $step)
                            @php
                                $isDone = $step->is_done;
                                $bgClass = $isDone
                                    ? 'bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500'
                                    : 'bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500';
                                $statusText = $isDone ? 'Sudah' : 'Belum';
                                $statusClass = $isDone
                                    ? 'bg-green-200 text-green-800 dark:bg-green-800 dark:text-green-200'
                                    : 'bg-red-200 text-red-800 dark:bg-red-800 dark:text-red-200';
                            @endphp
                            <li
                                class="text-gray-700 dark:text-gray-300 {{ $bgClass }} p-3 rounded-lg flex justify-between items-start">
                                <span>{{ $step->instruction_step }}</span>
                                <span class="ml-3 px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        @endif

        {{-- Material yang Dibutuhkan --}}
        @if ($task->materials && $task->materials->count() > 0)
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <i class="bi bi-box-seam text-orange-600"></i> Material Dibutuhkan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Nama Material</th>
                                    <th class="px-4 py-2 text-left">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($task->materials as $material)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $material->material_name }}</td>
                                        <td class="px-4 py-2">
                                            {{ $material->pivot->quantity ?? ($material->quantity ?? '-') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        {{-- Informasi Tambahan --}}
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="bi bi-paperclip text-purple-600"></i> Informasi Tambahan
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Foto</label>
                    @if ($task->photo_url)
                        <img src="{{ asset('storage/' . $task->photo_url) }}" alt="Foto Kerusakan"
                            class="max-h-48 rounded-lg shadow">
                    @else
                        <p class="text-gray-400 italic">Tidak ada foto</p>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Video</label>
                    @if ($task->video_url)
                        <video controls class="max-h-48 rounded-lg shadow">
                            <source src="{{ asset('storage/' . $task->video_url) }}" type="video/mp4">
                        </video>
                    @else
                        <p class="text-gray-400 italic">Tidak ada video</p>
                    @endif
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Informasi
                        Lainnya</label>
                    <p class="text-gray-700 dark:text-gray-300">{{ $task->additional_info ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
