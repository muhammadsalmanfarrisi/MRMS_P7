<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="font-manrope font-extrabold text-3xl md:text-4xl bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-700 dark:from-amber-200 dark:via-yellow-400 dark:to-amber-600 bg-clip-text text-transparent drop-shadow-lg">
                ✨ Buat Pekerjaan Maintenance Baru
            </h2>
            <div
                class="px-5 py-2.5 bg-white/60 dark:bg-white/10 backdrop-blur-md rounded-2xl border border-gray-300 dark:border-white/20 shadow-md">
                <span class="text-indigo-700 dark:text-amber-300 text-sm font-bold tracking-wide">Form Premium</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        {{-- Luxury animated background --}}
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
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- LEFT CARD: Informasi Kerusakan --}}
                    <div class="group" data-aos="fade-up" data-aos-duration="800">
                        <div
                            class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-purple-500/10">
                            <div
                                class="px-6 py-5 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-b border-white/20 dark:border-white/5">
                                <h3
                                    class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white tracking-tight">
                                    <i class="bi bi-shield-shaded text-2xl text-indigo-500"></i>
                                    <span>INFORMASI KERUSAKAN PREMIUM</span>
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                {{-- Alat / Mesin Rusak --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">🛠️
                                        Alat/Mesin Rusak</label>
                                    <input type="text" name="damaged_tool" value="{{ old('damaged_tool') }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 px-4 py-2.5 font-medium">
                                </div>

                                {{-- Penyebab (Opsional - sesuai field asli create) --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">🔍
                                        Penyebab</label>
                                    <textarea name="cause" rows="2"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 px-4 py-2.5">{{ old('cause') }}</textarea>
                                </div>

                                {{-- Deskripsi Kerusakan --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📝
                                        Deskripsi Kerusakan</label>
                                    <textarea name="description" rows="3"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 px-4 py-2.5">{{ old('description') }}</textarea>
                                </div>

                                {{-- Upload Foto & Video --}}
                                <div
                                    class="grid grid-cols-2 gap-5 p-4 bg-black/5 dark:bg-white/5 rounded-2xl border border-white/20">
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📸
                                            Foto</label>
                                        <input type="file" name="photo" accept="image/*"
                                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">🎥
                                            Video (MP4)</label>
                                        <input type="file" name="video" accept="video/mp4"
                                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT CARD: Penugasan & Status --}}
                    <div class="group" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                        <div
                            class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10">
                            <div
                                class="px-6 py-5 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 border-b border-white/20 dark:border-white/5">
                                <h3
                                    class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white tracking-tight">
                                    <i class="bi bi-tools text-2xl text-emerald-500"></i>
                                    <span>PENUGASAN & JADWAL</span>
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                {{-- Multi-select Pekerja --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">👥
                                        Ditugaskan Kepada (Multi-select)</label>
                                    <select name="employee_ids[]" id="worker-select" multiple="multiple"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80">
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->id }}"
                                                {{ in_array($worker->id, old('employee_ids', [])) ? 'selected' : '' }}>
                                                {{ $worker->name }} ({{ $worker->skill }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Deadline dengan Flatpickr --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-gray-400 mb-1">⏳
                                        Deadline</label>
                                    <div class="relative">
                                        <input type="text" id="luxury-deadline" name="deadline"
                                            value="{{ old('deadline') }}" placeholder="Pilih tanggal & waktu"
                                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800/80 focus:ring-2 focus:ring-amber-500 px-4 py-2.5 text-gray-800 dark:text-white cursor-pointer"
                                            readonly>
                                        <i
                                            class="bi bi-calendar-event-fill absolute right-4 top-1/2 -translate-y-1/2 text-amber-500 pointer-events-none text-lg"></i>
                                    </div>
                                </div>

                                {{-- Waktu Eksekusi dengan Flatpickr --}}


                                {{-- Instruksi Khusus --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">📋
                                        Instruksi Khusus</label>
                                    <textarea name="instructions" rows="2"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-indigo-500 px-4 py-2.5">{{ old('instructions') }}</textarea>
                                </div>

                                {{-- Kebutuhan Material (teks biasa) --}}


                                {{-- Catatan Tambahan --}}

                            </div>
                        </div>
                    </div>
                </div>

                {{-- DETAIL INSTRUCTION (SOP) - Luxury Card --}}
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
                            <div id="instruction-steps-container" class="space-y-3">
                                {{-- Jika ada old('steps'), loop; jika tidak, tampilkan satu baris kosong --}}
                                @if (old('steps'))
                                    @foreach (old('steps') as $step)
                                        <div class="flex gap-3 items-center group/step">
                                            <input type="text" name="steps[]" value="{{ $step }}"
                                                class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 focus:ring-2 focus:ring-sky-500 px-4 py-2.5">
                                            <button type="button" onclick="this.parentElement.remove()"
                                                class="text-red-500 hover:text-red-700 transition-all p-2 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex gap-3">
                                        <input type="text" name="steps[]" placeholder="Step 1: Check power supply..."
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

                {{-- MATERIALS & SPARE PARTS - Luxury Card --}}
                <div data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/30 dark:border-white/10 shadow-2xl overflow-hidden">
                        <div
                            class="px-6 py-5 bg-gradient-to-r from-emerald-500/10 to-green-500/10 border-b border-white/20 dark:border-white/5">
                            <h3 class="flex items-center gap-2 text-xl font-black text-gray-800 dark:text-white">
                                <i class="bi bi-box-seam text-2xl text-emerald-500"></i>
                                <span>MATERIALS & SPARE PARTS (DETAIL)</span>
                            </h3>
                        </div>
                        <div class="p-6">
                            <div id="material-container" class="space-y-4">
                                @if (old('material_names'))
                                    @foreach (old('material_names') as $index => $name)
                                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                            <div class="flex-1 w-full">
                                                <input type="text" name="material_names[]"
                                                    value="{{ $name }}" placeholder="Nama Material"
                                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 px-4 py-2.5">
                                            </div>
                                            <div class="w-full sm:w-40">
                                                <input type="text" name="material_quantities[]"
                                                    value="{{ old('material_quantities')[$index] ?? '' }}"
                                                    placeholder="Qty"
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

                {{-- ACTION BUTTONS --}}
                <div class="flex justify-end gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('tasks.index') }}"
                        class="group relative overflow-hidden px-8 py-3 rounded-2xl bg-white/30 backdrop-blur-md border border-white/40 text-gray-700 dark:text-gray-200 font-bold transition-all duration-300 hover:bg-white/50 hover:shadow-lg">
                        <span class="relative z-10">Batal</span>
                    </a>
                    <button type="submit"
                        class="group relative overflow-hidden px-10 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        <span class="relative z-10 flex items-center gap-2">
                            <i class="bi bi-cloud-upload-fill"></i> Simpan Pekerjaan
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- REQUIRED SCRIPTS & STYLES --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        $(document).ready(function() {
            // Luxury Select2
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

            // Flatpickr untuk Deadline
            flatpickr("#luxury-deadline", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 1,
                allowInput: false,
                disableMobile: true,
                position: "auto",
                static: false,
                appendTo: document.body,
                animate: true,
                theme: "material_blue",
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('luxury-calendar');
                    instance.calendarContainer.style.zIndex = "9999";
                }
            });

            // Flatpickr untuk Waktu Eksekusi
            flatpickr("#luxury-execution", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 1,
                allowInput: false,
                disableMobile: true,
                position: "auto",
                static: false,
                appendTo: document.body,
                animate: true,
                theme: "material_blue",
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('luxury-calendar');
                    instance.calendarContainer.style.zIndex = "9999";
                }
            });
        });

        // Add step dynamic
        document.getElementById('add-step').addEventListener('click', function() {
            const container = document.getElementById('instruction-steps-container');
            const div = document.createElement('div');
            div.className = 'flex gap-3 items-center group/step mt-3';
            div.innerHTML = `
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
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Manrope', sans-serif;
        }

        .font-manrope {
            font-family: 'Manrope', sans-serif;
        }

        .backdrop-blur-xl {
            backdrop-filter: blur(16px);
        }

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

        .flatpickr-calendar {
            z-index: 9999 !important;
            overflow: visible !important;
        }

        .bg-white\/90,
        .dark\:bg-gray-900\/70 {
            overflow: visible !important;
        }
    </style>
</x-app-layout>
