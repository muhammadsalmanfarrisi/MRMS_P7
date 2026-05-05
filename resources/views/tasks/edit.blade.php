<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="font-manrope font-extrabold text-3xl md:text-4xl bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-700 dark:from-amber-200 dark:via-yellow-400 dark:to-amber-600 bg-clip-text text-transparent drop-shadow-lg">
                ✨ Edit Pekerjaan Maintenance
            </h2>
            <div
                class="px-5 py-2.5 bg-white/60 dark:bg-white/10 backdrop-blur-md rounded-2xl border border-gray-300 dark:border-white/20 shadow-md">
                <span
                    class="text-indigo-700 dark:text-amber-300 text-sm font-bold tracking-wide">{{ $task->damaged_tool }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Luxury animated background -->
        <div class="absolute inset-0 -z-10">
            <div
                class="absolute top-0 -left-40 w-96 h-96 bg-purple-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute top-0 -right-40 w-96 h-96 bg-yellow-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-40 left-20 w-96 h-96 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf
                @if (request()->has('from') && request('from') === 'overdue')
                    <input type="hidden" name="from" value="overdue">
                @endif
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- LEFT CARD: Informasi Kerusakan -->
                    <div class="group" data-aos="fade-up" data-aos-duration="800">
                        <div
                            class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-purple-500/10">
                            <div
                                class="px-6 py-5 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-b border-white/20 dark:border-white/5">
                                <h3
                                    class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white tracking-tight">
                                    <i class="bi bi-shield-shaded text-2xl text-indigo-500"></i>
                                    <span>INFORMASI KERUSAKAN</span>
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📋
                                            Pelapor</label>
                                        <input type="text" value="{{ $task->reporter_name }}"
                                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-inner cursor-not-allowed font-medium text-gray-700 dark:text-gray-300 px-4 py-2.5">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">⏱️
                                            Waktu Lapor</label>
                                        <input type="text"
                                            value="{{ \Carbon\Carbon::parse($task->report_time)->format('d M Y, H:i') }}"
                                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-inner cursor-not-allowed font-medium">
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">🛠️
                                        Alat/Mesin Rusak</label>
                                    <input type="text" name="damaged_tool"
                                        value="{{ old('damaged_tool', $task->damaged_tool) }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 px-4 py-2.5 font-medium">
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📝
                                        Penyebab/Kronologi Kerusakan</label>
                                    <textarea name="cause" rows="3"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 px-4 py-2.5">{{ old('cause', $task->cause) }}</textarea>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📝
                                        Deskripsi Kerusakan</label>
                                    <textarea name="description" rows="3"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 px-4 py-2.5">{{ old('description', $task->description) }}</textarea>
                                </div>

                                <div
                                    class="grid grid-cols-2 gap-5 p-4 bg-black/5 dark:bg-white/5 rounded-2xl border border-white/20">
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📸
                                            Ganti Foto</label>
                                        <input type="file" name="photo" accept="image/*"
                                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                                        @if ($task->photo_url)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $task->photo_url) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $task->photo_url) }}"
                                                        alt="Foto Kerusakan"
                                                        class="w-32 rounded-lg shadow-lg hover:scale-105 transition-transform">
                                                </a>
                                                <a href="{{ asset('storage/' . $task->photo_url) }}" target="_blank"
                                                    class="inline-flex items-center gap-1 text-xs text-indigo-500 mt-2 hover:underline">
                                                    <i class="bi bi-image-fill"></i> Lihat Foto Lama
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">🎥
                                            Ganti Video</label>
                                        <input type="file" name="video" accept="video/mp4"
                                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition-all">
                                        @if ($task->video_url)
                                            <div class="mt-2">
                                                <video controls class="w-48 rounded-lg shadow-lg">
                                                    <source src="{{ asset('storage/' . $task->video_url) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <a href="{{ asset('storage/' . $task->video_url) }}" target="_blank"
                                                    class="inline-flex items-center gap-1 text-xs text-rose-500 mt-2 hover:underline">
                                                    <i class="bi bi-play-circle-fill"></i> Lihat Video Lama
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT CARD: Penugasan & Status -->
                    <div class="group" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                        <div
                            class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10">
                            <div
                                class="px-6 py-5 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 border-b border-white/20 dark:border-white/5">
                                <h3
                                    class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white tracking-tight">
                                    <i class="bi bi-tools text-2xl text-emerald-500"></i>
                                    <span>PENUGASAN & STATUS</span>
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">👥
                                        Ditugaskan Kepada (Multi-select)</label>
                                    <select name="employee_ids[]" id="worker-select" multiple="multiple"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80">
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->id }}"
                                                {{ collect(old('employee_ids', $task->employees->pluck('id')))->contains($worker->id) ? 'selected' : '' }}>
                                                {{ $worker->name }} ({{ $worker->skill }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-gray-400 mb-1">⏳
                                        Deadline</label>
                                    <div class="relative">
                                        <input type="text" id="luxury-deadline" name="deadline"
                                            value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') : '' }}"
                                            placeholder="Pilih tanggal & waktu"
                                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800/80 focus:ring-2 focus:ring-amber-500 px-4 py-2.5 text-gray-800 dark:text-white cursor-pointer"
                                            readonly>
                                        <i
                                            class="bi bi-calendar-event-fill absolute right-4 top-1/2 -translate-y-1/2 text-amber-500 pointer-events-none text-lg"></i>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📋
                                        Instruksi Khusus</label>
                                    <textarea name="instructions" rows="2"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 px-4 py-2.5">{{ old('instructions', $task->instructions) }}</textarea>
                                </div>



                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📌
                                        Status</label>
                                    <select name="status"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 px-4 py-2.5">
                                        <option value="unprocessed">⏳ Belum di Proses</option>
                                        <option value="processed" selected>⚡ Sedang di Proses</option>
                                        <option value="worked_on">🛠️ Sedang Dikerjakan</option>
                                        <option value="finished">✅ Selesai Dikerjakan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DETAIL INSTRUCTION (SOP) - Luxury Card -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
                        <div
                            class="px-6 py-5 bg-gradient-to-r from-sky-500/10 to-blue-500/10 border-b border-white/20 dark:border-white/5">
                            <h3 class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white">
                                <i class="bi bi-list-check text-2xl text-sky-500"></i>
                                <span>DETAILED INSTRUCTIONS (SOP STEPS)</span>
                            </h3>
                        </div>
                        <div class="p-6">
                            {{-- Ambil status instruksi terbaru dari laporan progress --}}
                            @php
                                $latestInstructionStatus = collect();
                                $latestProgress = $task->reportProgresses()->latest()->first();
                                if ($latestProgress) {
                                    $latestInstructionStatus = $latestProgress->instructionsDone->keyBy(
                                        'instruction_id',
                                    );
                                }
                            @endphp

                            <div id="instruction-steps-container" class="space-y-3">
                                @if (isset($task) && $task->detail_instructions->count() > 0)
                                    @foreach ($task->detail_instructions as $instruction)
                                        @php
                                            $instStatus = $latestInstructionStatus->get($instruction->id);
                                            $isDone = $instStatus->is_done ?? null;
                                        @endphp
                                        <div class="flex gap-3 items-center group/step">
                                            {{-- TAMBAHKAN INI --}}
                                            <input type="hidden" name="instruction_ids[]"
                                                value="{{ $instruction->id }}">
                                            {{-- AKHIR TAMBAHAN --}}

                                            <input type="text" name="steps[]"
                                                value="{{ $instruction->instruction_step }}"
                                                class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-sky-500 px-4 py-2.5">

                                            {{-- Badge status pengerjaan terbaru --}}
                                            @if (!is_null($isDone))
                                                <span
                                                    class="px-3 py-1 text-xs font-bold rounded-full whitespace-nowrap {{ $isDone ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400' }}">
                                                    {{ $isDone ? '✅ Selesai' : '❌ Belum' }}
                                                </span>
                                            @endif

                                            <button type="button" onclick="this.parentElement.remove()"
                                                class="text-red-500 hover:text-red-700 transition-all p-2 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex gap-3">
                                        <input type="text" name="steps[]"
                                            placeholder="Step 1: Check power supply..."
                                            class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-step"
                                class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-sky-600 dark:text-sky-400 hover:gap-3 transition-all duration-300">
                                <i class="bi bi-plus-circle-fill"></i> Add Another Step
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MATERIALS & SPARE PARTS - Luxury Card -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
                        <div
                            class="px-6 py-5 bg-gradient-to-r from-emerald-500/10 to-green-500/10 border-b border-white/20 dark:border-white/5">
                            <h3 class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white">
                                <i class="bi bi-box-seam text-2xl text-emerald-500"></i>
                                <span>MATERIALS & SPARE PARTS</span>
                            </h3>
                        </div>
                        <div class="p-6">
                            <div id="material-container" class="space-y-4">
                                @if (isset($task) && $task->materials->count() > 0)
                                    @foreach ($task->materials as $material)
                                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                            <div class="flex-1 w-full">
                                                <input type="text" name="material_names[]"
                                                    value="{{ $material->material_name }}"
                                                    placeholder="Nama Material"
                                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                            </div>
                                            <div class="w-full sm:w-40">
                                                <input type="text" name="material_quantities[]"
                                                    value="{{ $material->quantity }}" placeholder="Qty"
                                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                            </div>
                                            <button type="button" onclick="this.parentElement.remove()"
                                                class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition-all">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                        <div class="flex-1 w-full">
                                            <input type="text" name="material_names[]"
                                                placeholder="Contoh: Bearing 6205"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                        </div>
                                        <div class="w-full sm:w-40">
                                            <input type="text" name="material_quantities[]"
                                                placeholder="Qty (Pcs/Ltr)"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-material"
                                class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:gap-3 transition-all duration-300">
                                <i class="bi bi-plus-circle-fill"></i> Add More Material
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex justify-end gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ request('from') === 'overdue' ? route('tasks.overdue') : route('tasks.index') }}"
                        class="group relative overflow-hidden px-8 py-3 rounded-2xl bg-white/30 backdrop-blur-md border border-white/40 text-gray-700 dark:text-gray-200 font-bold transition-all duration-300 hover:bg-white/50 hover:shadow-lg">
                        <span class="relative z-10">Batal</span>
                    </a>
                    <button type="submit"
                        class="group relative overflow-hidden px-10 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        <span class="relative z-10 flex items-center gap-2">
                            <i class="bi bi-cloud-arrow-up-fill"></i> Perbarui Pekerjaan
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                    </button>
                </div>
            </form>
            {{-- ==================== LAPORAN PEKERJAAN & PROGRESS ==================== --}}
            @php
                // Cek apakah workReports relasi ada (untuk antisipasi jika model WorkReport belum dibuat)
                $workReport = method_exists($task, 'workReports')
                    ? $task->workReports()->whereNotNull('completed_at')->latest('completed_at')->first()
                    : null;
                $progressReports = $task
                    ->reportProgresses()
                    ->with(['employee', 'instructionsDone'])
                    ->latest()
                    ->get();
            @endphp

            {{-- LAPORAN PEKERJAAN FINAL (WorkReport) --}}
            @if ($workReport)
                <div class="relative mt-8" data-aos="fade-up" data-aos-duration="1000">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-500 rounded-3xl blur-xl opacity-30 animate-pulse">
                    </div>
                    <div
                        class="relative bg-white/80 dark:bg-gray-900/80 backdrop-blur-2xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
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
                                            LAPORAN PEKERJAAN (FINAL)
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                            <i class="bi bi-clock-history"></i> Diselesaikan
                                            {{ $workReport->completed_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="px-4 py-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-full text-xs font-bold text-emerald-700 dark:text-emerald-300 border border-emerald-200">
                                    ✅ Selesai
                                </span>
                            </div>
                        </div>
                        <div class="p-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div
                                class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-5 transition-all hover:shadow-2xl hover:shadow-emerald-500/10">
                                <h4 class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-4"><i
                                        class="bi bi-camera-fill text-emerald-500"></i> 📸 Foto Pekerjaan</h4>
                                @if ($workReport->photo)
                                    <a href="{{ asset('storage/' . $workReport->photo) }}" target="_blank"
                                        class="block relative">
                                        <img src="{{ asset('storage/' . $workReport->photo) }}"
                                            class="max-h-64 rounded-xl shadow-xl hover:scale-105 transition-transform">
                                    </a>
                                @else
                                    <p class="text-gray-400 italic">Tidak ada foto</p>
                                @endif
                            </div>
                            <div
                                class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-5 transition-all hover:shadow-2xl hover:shadow-teal-500/10">
                                <h4 class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-4"><i
                                        class="bi bi-play-circle-fill text-teal-500"></i> 🎥 Video Pekerjaan</h4>
                                @if ($workReport->video)
                                    <video controls class="w-full max-h-64 rounded-xl shadow-xl">
                                        <source src="{{ asset('storage/' . $workReport->video) }}" type="video/mp4">
                                    </video>
                                @else
                                    <p class="text-gray-400 italic">Tidak ada video</p>
                                @endif
                            </div>
                            <div
                                class="lg:col-span-2 bg-gradient-to-br from-gray-50 to-emerald-50/50 dark:from-gray-800/50 dark:to-emerald-900/10 rounded-2xl border border-gray-200 dark:border-gray-700/50 p-6">
                                <h4 class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-6">Detail
                                    Laporan</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div
                                        class="bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 shadow-lg">
                                        <div class="flex items-center gap-2 mb-3"><i
                                                class="bi bi-exclamation-triangle-fill text-amber-600"></i>
                                            <h5 class="font-bold text-sm">Kondisi Awal</h5>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                                            {{ $workReport->initial_condition ?? '-' }}</p>
                                    </div>
                                    <div
                                        class="bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 shadow-lg">
                                        <div class="flex items-center gap-2 mb-3"><i
                                                class="bi bi-tools text-blue-600"></i>
                                            <h5 class="font-bold text-sm">Perbaikan</h5>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                                            {{ $workReport->repair_done ?? '-' }}</p>
                                    </div>
                                    <div
                                        class="bg-white/80 dark:bg-gray-900/80 rounded-xl p-4 border border-white/30 shadow-lg">
                                        <div class="flex items-center gap-2 mb-3"><i
                                                class="bi bi-search text-purple-600"></i>
                                            <h5 class="font-bold text-sm">Analisa Penyebab</h5>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                                            {{ $workReport->damage_cause_analysis ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- LAPORAN PROGRESS (ReportProgress) --}}
            @if ($progressReports->count() > 0)
                <div class="relative mt-8" data-aos="fade-up" data-aos-duration="1000">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="p-3 bg-gradient-to-br from-violet-400 to-purple-600 rounded-2xl shadow-lg shadow-purple-500/20">
                            <i class="bi bi-bar-chart-steps text-3xl text-white"></i>
                        </div>
                        <div>
                            <h3
                                class="text-2xl font-black bg-gradient-to-r from-violet-700 to-purple-700 dark:from-violet-300 dark:to-purple-300 bg-clip-text text-transparent">
                                LAPORAN PROGRESS
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ $progressReports->count() }} laporan perkembangan</p>
                        </div>
                    </div>
                    <div class="space-y-8">
                        @foreach ($progressReports as $index => $report)
                            <div class="relative group/card">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-purple-400 via-pink-400 to-rose-400 rounded-3xl blur-xl opacity-20 group-hover/card:opacity-40 transition-all duration-500">
                                </div>
                                <div
                                    class="relative bg-white/80 dark:bg-gray-900/80 backdrop-blur-2xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
                                    <div
                                        class="px-8 py-5 bg-gradient-to-r from-purple-500/10 via-pink-500/10 to-rose-500/10 border-b border-white/30 dark:border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="flex items-center justify-center w-8 h-8 rounded-full bg-white dark:bg-gray-800 text-purple-600 font-bold text-sm shadow">{{ $index + 1 }}</span>
                                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400"><i
                                                    class="bi bi-calendar-check"></i>
                                                {{ $report->created_at->translatedFormat('d M Y, H:i') }}</p>
                                            @if ($report->employee)
                                                <span
                                                    class="inline-flex items-center gap-1 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-300 text-xs px-3 py-1 rounded-full"><i
                                                        class="bi bi-person-circle"></i>
                                                    {{ $report->employee->name }}</span>
                                            @endif
                                        </div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-purple-50 dark:bg-purple-900/30 rounded-full text-xs font-bold text-purple-700 dark:text-purple-300 border border-purple-200">Update
                                            #{{ $index + 1 }}</span>
                                    </div>
                                    <div class="p-6 md:p-8 space-y-6">
                                        @if (!is_null($report->progress_percent))
                                            <div
                                                class="bg-gray-100 dark:bg-gray-800 rounded-full h-6 overflow-hidden shadow-inner">
                                                <div class="h-full bg-gradient-to-r from-purple-500 via-pink-500 to-rose-500 rounded-full flex items-center justify-end pr-2"
                                                    style="width: {{ $report->progress_percent }}%">
                                                    <span
                                                        class="text-white text-xs font-bold drop-shadow">{{ $report->progress_percent }}%</span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                            <div
                                                class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border p-5">
                                                <h4
                                                    class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-4">
                                                    <i class="bi bi-camera-fill text-purple-500"></i> 📸 Foto Progress
                                                </h4>
                                                @if ($report->photo_path)
                                                    <a href="{{ asset('storage/' . $report->photo_path) }}"
                                                        target="_blank" class="block">
                                                        <img src="{{ asset('storage/' . $report->photo_path) }}"
                                                            class="max-h-64 rounded-xl shadow-xl hover:scale-105 transition-transform">
                                                    </a>
                                                @else
                                                    <p class="text-gray-400 italic">Tidak ada foto</p>
                                                @endif
                                            </div>
                                            <div
                                                class="group relative bg-gray-50 dark:bg-gray-800/50 rounded-2xl border p-5">
                                                <h4
                                                    class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-4">
                                                    <i class="bi bi-play-circle-fill text-pink-500"></i> 🎥 Video
                                                    Progress
                                                </h4>
                                                @if ($report->video_path)
                                                    <video controls class="w-full max-h-64 rounded-xl shadow-xl">
                                                        <source src="{{ asset('storage/' . $report->video_path) }}"
                                                            type="video/mp4">
                                                    </video>
                                                @else
                                                    <p class="text-gray-400 italic">Tidak ada video</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="bg-white/80 dark:bg-gray-900/80 rounded-2xl p-5 border">
                                                <div class="flex items-center gap-2 mb-3"><i
                                                        class="bi bi-card-text text-blue-600"></i>
                                                    <h5 class="font-bold text-sm">Deskripsi</h5>
                                                </div>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $report->description ?? '-' }}</p>
                                            </div>
                                            <div class="bg-white/80 dark:bg-gray-900/80 rounded-2xl p-5 border">
                                                <div class="flex items-center gap-2 mb-3"><i
                                                        class="bi bi-exclamation-triangle-fill text-amber-600"></i>
                                                    <h5 class="font-bold text-sm">Kendala</h5>
                                                </div>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                                    {{ $report->obstacles ?? '-' }}</p>
                                            </div>
                                        </div>
                                        @if ($report->instructionsDone->count() > 0)
                                            <div
                                                class="bg-gradient-to-br from-gray-50 to-purple-50/50 dark:from-gray-800/50 dark:to-purple-900/10 rounded-2xl border p-6">
                                                <h4
                                                    class="text-sm font-bold uppercase text-gray-500 dark:text-gray-400 mb-4">
                                                    Status Instruksi</h4>
                                                @foreach ($report->instructionsDone as $inst)
                                                    <div
                                                        class="flex items-center justify-between bg-white/80 dark:bg-gray-900/80 p-3 rounded-xl border mb-2">
                                                        <span
                                                            class="text-sm">{{ $inst->step ?? 'Instruksi #' . $inst->instruction_id }}</span>
                                                        <span
                                                            class="px-3 py-1 text-xs font-bold rounded-full {{ $inst->is_done ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $inst->is_done ? '✅ Selesai' : '❌ Belum' }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- REQUIRED SCRIPTS WITH ENHANCEMENTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        $(document).ready(function() {
            // Luxury Select2 with custom styling
            $('#worker-select').select2({
                placeholder: "-- Pilih Satu atau Lebih Pekerja --",
                allowClear: true,
                width: '100%',
                theme: 'classic',
                dropdownCssClass: 'luxury-dropdown'
            });

            AOS.init({
                duration: 800,
                once: true,
                mirror: false,
                easing: 'ease-out-quad'
            });

            // Inisialisasi datepicker mewah untuk deadline
            flatpickr("#luxury-deadline", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 1,
                allowInput: false,
                disableMobile: true,
                static: true,
                position: "auto",
                animate: true,
                theme: "material_blue",
                onChange: function(selectedDates, dateStr, instance) {
                    // Optional: trigger event jika perlu
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Styling tambahan untuk kalender
                    instance.calendarContainer.classList.add('luxury-calendar');
                }
            });
            // Inisialisasi Flatpickr untuk deadline
            // Ganti inisialisasi Flatpickr dengan ini
            const deadlinePicker = flatpickr("#luxury-deadline", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 1,
                allowInput: false,
                disableMobile: true,
                position: "auto", // atau "above" / "below"
                static: false, // penting agar tidak terpotong
                appendTo: document.body, // tempelkan ke body agar tidak terbatas container
                animate: true,
                theme: "material_blue",
                defaultDate: "{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') : \Carbon\Carbon::now('Asia/jakarta')->format('Y-m-d H:i') }}",
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('luxury-calendar');
                    instance.calendarContainer.style.zIndex = "9999";
                }
            });

            // Tombol Sekarang: set ke datetime sekarang
            document.getElementById('btn-now-deadline').addEventListener('click', function() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const formattedNow = `${year}-${month}-${day} ${hours}:${minutes}`;

                deadlinePicker.setDate(formattedNow, true); // update value flatpickr
            });
        });

        // Add step dynamic
        document.getElementById('add-step').addEventListener('click', function() {
            const container = document.getElementById('instruction-steps-container');
            const div = document.createElement('div');
            div.className = 'flex gap-3 items-center group/step mt-3';
            div.innerHTML = `
                <input type="hidden" name="instruction_ids[]" value="">
                <input type="text" name="steps[]" placeholder="Next step..." class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5 focus:ring-2 focus:ring-sky-500">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition-all">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            `;
            container.appendChild(div);
        });

        // Add material dynamic
        document.getElementById('add-material').addEventListener('click', function() {
            const container = document.getElementById('material-container');
            const div = document.createElement('div');
            div.className = 'flex flex-col sm:flex-row gap-4 items-start sm:items-center mt-4';
            div.innerHTML = `
                <div class="flex-1 w-full">
                    <input type="text" name="material_names[]" placeholder="Material Name" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                </div>
                <div class="w-full sm:w-40">
                    <input type="text" name="material_quantities[]" placeholder="Qty" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition-all">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            `;
            container.appendChild(div);
        });
    </script>

    <style>
        /* Custom Luxury Styles */
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Manrope', sans-serif;
        }

        .font-manrope {
            font-family: 'Manrope', sans-serif;
        }

        /* Glassmorphism enhancements */
        .backdrop-blur-xl {
            backdrop-filter: blur(16px);
        }

        /* Animated blob background */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 12s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Select2 Luxury Override */
        .select2-container--classic .select2-selection--multiple {
            background-color: rgba(255, 255, 255, 0.8) !important;
            border: 1px solid rgba(209, 213, 219, 0.5) !important;
            border-radius: 0.75rem !important;
            padding: 0.25rem !important;
        }

        .dark .select2-container--classic .select2-selection--multiple {
            background-color: rgba(31, 41, 55, 0.8) !important;
            border-color: rgba(55, 65, 81, 0.8) !important;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice {
            background-color: #4f46e5 !important;
            border: none !important;
            color: white !important;
            border-radius: 9999px !important;
            padding: 0.2rem 0.7rem !important;
            font-size: 0.75rem !important;
        }

        .select2-dropdown {
            border-radius: 1rem !important;
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        .dark .select2-dropdown {
            background-color: rgba(17, 24, 39, 0.9) !important;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #a855f7, #6366f1);
            border-radius: 10px;
        }

        /* Input focus effect */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        /* Luxury Flatpickr Calendar */
        .luxury-calendar {
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(12px) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(255, 215, 0, 0.3) !important;
            font-family: 'Manrope', sans-serif !important;
        }

        .dark .luxury-calendar {
            background: rgba(17, 24, 39, 0.95) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
        }

        .flatpickr-day.selected {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            border-color: #f59e0b !important;
            box-shadow: 0 0 8px rgba(245, 158, 11, 0.6) !important;
        }

        .flatpickr-day.today {
            border-color: #f59e0b !important;
            font-weight: bold !important;
        }

        .flatpickr-time input:hover,
        .flatpickr-time input:focus {
            background: rgba(245, 158, 11, 0.1) !important;
        }

        .flatpickr-calendar .flatpickr-months .flatpickr-prev-month,
        .flatpickr-calendar .flatpickr-months .flatpickr-next-month {
            fill: #f59e0b !important;
        }

        /* Luxury Flatpickr Calendar */
        .luxury-calendar {
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(12px) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(245, 158, 11, 0.3) !important;
            font-family: 'Manrope', sans-serif !important;
        }

        .dark .luxury-calendar {
            background: rgba(17, 24, 39, 0.95) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
        }

        .flatpickr-day.selected {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            border-color: #f59e0b !important;
            box-shadow: 0 0 8px rgba(245, 158, 11, 0.6) !important;
        }

        .flatpickr-day.today {
            border-color: #f59e0b !important;
            font-weight: bold !important;
        }

        /* Pastikan kalender Flatpickr tidak terpotong */
        .flatpickr-calendar {
            z-index: 9999 !important;
            overflow: visible !important;
        }

        /* Jika card punya overflow hidden, ubah sementara */
        .bg-white\/90,
        .dark\:bg-gray-900\/70 {
            overflow: visible !important;
        }
    </style>
</x-app-layout>
