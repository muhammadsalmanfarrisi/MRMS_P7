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
                                {{-- <span>Dibuat: {{ $task->created_at->translatedFormat('d M Y, H:i') }}</span> --}}
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
                    @if ($task->completed_at)
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Selesai</label>
                            <p class="text-gray-700 dark:text-gray-300 flex items-center gap-1">
                                <i class="bi bi-check-circle text-green-500"></i>
                                {{ \Carbon\Carbon::parse($task->completed_at)->translatedFormat('d M Y, H:i') }}
                            </p>
                        </div>
                    @endif
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

        {{-- ==================== LAPORAN PEKERJAAN MEWAH ==================== --}}
        @php
            $workReport = $task->workReports()->whereNotNull('completed_at')->latest('completed_at')->first();
        @endphp

        @if ($workReport)
            <div class="relative mt-8" data-aos="fade-up" data-aos-duration="1000">
                <!-- Ornamen latar premium -->
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-500 rounded-3xl blur-xl opacity-30 animate-pulse">
                </div>

                <div
                    class="relative bg-white/80 dark:bg-gray-900/80 backdrop-blur-2xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
                    <!-- Header card -->
                    <div
                        class="relative px-8 py-6 bg-gradient-to-r from-emerald-500/20 via-teal-500/20 to-cyan-500/20 border-b border-white/30 dark:border-white/10">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-3 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl shadow-lg shadow-emerald-500/20">
                                    <i class="bi bi-clipboard-check text-3xl text-white"></i>
                                </div>
                                <div>
                                    <h3
                                        class="text-2xl font-black bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 dark:from-emerald-300 dark:via-teal-300 dark:to-cyan-300 bg-clip-text text-transparent tracking-tight">
                                        LAPORAN PEKERJAAN
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                        <i class="bi bi-clock-history"></i> Diselesaikan pada
                                        {{ $workReport->completed_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-2 px-4 py-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-full border border-emerald-200 dark:border-emerald-600/30">
                                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                                <span
                                    class="text-xs font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-wider">Selesai</span>
                            </div>
                        </div>
                    </div>

                    <!-- Konten utama -->
                    <div class="p-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Foto -->
                        <div
                            class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-5 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/10 hover:border-emerald-200 dark:hover:border-emerald-600/30">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-t-2xl scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                            </div>
                            <h4
                                class="text-sm font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4 flex items-center gap-2">
                                <i class="bi bi-camera-fill text-emerald-500"></i> 📸 Foto Pekerjaan
                            </h4>
                            <div class="flex justify-center">
                                @if ($workReport->photo)
                                    <a href="{{ asset('storage/' . $workReport->photo) }}" target="_blank"
                                        class="block relative">
                                        <img src="{{ asset('storage/' . $workReport->photo) }}" alt="Foto Pekerjaan"
                                            class="max-h-64 rounded-xl shadow-xl group-hover:scale-105 transition-transform duration-500 ease-out">
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-black/30 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <span
                                                class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white font-bold text-sm">
                                                <i class="bi bi-arrows-fullscreen"></i> Lihat Penuh
                                            </span>
                                        </div>
                                    </a>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center py-12 text-gray-400 dark:text-gray-500">
                                        <i class="bi bi-image-alt text-5xl text-gray-300 dark:text-gray-600 mb-2"></i>
                                        <p class="text-sm font-medium italic">Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Video -->
                        <div
                            class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-5 transition-all duration-500 hover:shadow-2xl hover:shadow-teal-500/10 hover:border-teal-200 dark:hover:border-teal-600/30">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 to-cyan-500 rounded-t-2xl scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                            </div>
                            <h4
                                class="text-sm font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4 flex items-center gap-2">
                                <i class="bi bi-play-circle-fill text-teal-500"></i> 🎥 Video Pekerjaan
                            </h4>
                            <div class="flex justify-center">
                                @if ($workReport->video)
                                    <div class="relative group/video w-full">
                                        <video controls
                                            class="w-full max-h-64 rounded-xl shadow-xl group-hover:scale-105 transition-transform duration-500">
                                            <source src="{{ asset('storage/' . $workReport->video) }}"
                                                type="video/mp4">
                                            Browser Anda tidak mendukung.
                                        </video>
                                        <a href="{{ asset('storage/' . $workReport->video) }}" target="_blank"
                                            class="absolute top-3 right-3 px-3 py-1.5 bg-white/30 backdrop-blur-md rounded-lg text-white text-xs font-bold opacity-0 group-hover/video:opacity-100 transition-opacity duration-300">
                                            <i class="bi bi-box-arrow-up-right"></i> Buka
                                        </a>
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center py-12 text-gray-400 dark:text-gray-500">
                                        <i class="bi bi-film text-5xl text-gray-300 dark:text-gray-600 mb-2"></i>
                                        <p class="text-sm font-medium italic">Tidak ada video</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Detail Laporan -->
                        <div
                            class="lg:col-span-2 bg-gradient-to-br from-gray-50 to-emerald-50/50 dark:from-gray-800/50 dark:to-emerald-900/10 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6">
                            <h4
                                class="text-sm font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-6 flex items-center gap-2">
                                <i class="bi bi-card-text text-emerald-500"></i> Detail Laporan Pengerjaan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Kondisi Awal -->
                                <div
                                    class="relative bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 dark:border-white/10 shadow-lg">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg">
                                            <i class="bi bi-exclamation-triangle-fill text-amber-600"></i>
                                        </div>
                                        <h5 class="font-bold text-gray-700 dark:text-gray-300 text-sm">Kondisi Awal
                                        </h5>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                                        {{ $workReport->initial_condition ?? '-' }}</p>
                                </div>

                                <!-- Perbaikan -->
                                <div
                                    class="relative bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 dark:border-white/10 shadow-lg">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                            <i class="bi bi-tools text-blue-600"></i>
                                        </div>
                                        <h5 class="font-bold text-gray-700 dark:text-gray-300 text-sm">Perbaikan
                                            Dilakukan</h5>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                                        {{ $workReport->repair_done ?? '-' }}</p>
                                </div>

                                <!-- Analisa Penyebab -->
                                <div
                                    class="relative bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 dark:border-white/10 shadow-lg">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                                            <i class="bi bi-search text-purple-600"></i>
                                        </div>
                                        <h5 class="font-bold text-gray-700 dark:text-gray-300 text-sm">Analisa Penyebab
                                        </h5>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                                        {{ $workReport->damage_cause_analysis ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
