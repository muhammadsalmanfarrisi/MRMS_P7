<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 opacity-10"></div>
            <div class="relative flex items-center gap-3">
                <div class="p-2 bg-white/20 dark:bg-gray-800/30 backdrop-blur rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600 dark:text-emerald-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2
                    class="text-2xl font-bold bg-gradient-to-r from-emerald-700 to-teal-700 dark:from-emerald-300 dark:to-teal-300 bg-clip-text text-transparent">
                    {{ __('Tambah Pekerja Baru') }}
                </h2>
                <span
                    class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-200">
                    <i class="bi bi-star-fill mr-1 text-xs"></i> Formulir Premium
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Card Utama --}}
            <div
                class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 transition-all duration-500">
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-300 dark:bg-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-teal-300 dark:bg-teal-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20">
                </div>

                <div class="relative p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Informasi Pekerja</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Isi data pekerja dengan lengkap dan
                                akurat</p>
                        </div>
                    </div>

                    <form action="{{ route('employees.store') }}" method="POST" id="employeeForm" class="space-y-6">
                        @csrf

                        {{-- Nama Lengkap (floating label) --}}
                        <div class="relative group">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="name"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1"><i
                                        class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Keahlian (floating label + select custom) --}}
                        <div class="relative group">
                            <select name="skill" id="skillSelect"
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all duration-300 appearance-none"
                                required>
                                <option value=""> </option>
                                <option value="Administrasi" {{ old('skill') == 'Administrasi' ? 'selected' : '' }}>
                                    Administrasi</option>
                                <option value="Akuntansi" {{ old('skill') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi
                                </option>
                                <option value="Gudang" {{ old('skill') == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                <option value="Produksi" {{ old('skill') == 'Produksi' ? 'selected' : '' }}>Produksi
                                </option>
                                <option value="Pengemasan" {{ old('skill') == 'Pengemasan' ? 'selected' : '' }}>
                                    Pengemasan</option>
                                <option value="Quality Control"
                                    {{ old('skill') == 'Quality Control' ? 'selected' : '' }}>Quality Control</option>
                                <option value="Teknisi Mesin" {{ old('skill') == 'Teknisi Mesin' ? 'selected' : '' }}>
                                    Teknisi Mesin</option>
                                <option value="Supervisor" {{ old('skill') == 'Supervisor' ? 'selected' : '' }}>
                                    Supervisor</option>
                                <option value="Manajer" {{ old('skill') == 'Manajer' ? 'selected' : '' }}>Manajer
                                </option>
                                <option value="Lainnya" {{ old('skill') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            <label for="skillSelect"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                Keahlian <span class="text-red-500">*</span>
                            </label>
                            <div class="absolute right-3 top-3.5 pointer-events-none text-gray-400">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            @error('skill')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1"><i
                                        class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Telepon (floating label) --}}
                        <div class="relative group">
                            <input type="tel" name="phone_number" id="phone_number"
                                value="{{ old('phone_number') }}"
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="phone_number"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                No. Telepon
                            </label>
                            <div class="absolute right-3 top-3 text-gray-400">
                                <i class="bi bi-phone"></i>
                            </div>
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Telegram Username (floating label) --}}
                        <div class="relative group">
                            <div class="absolute left-4 top-3.5 text-gray-500 dark:text-gray-400 z-10">
                                <i class="bi bi-telegram"></i>
                            </div>
                            <input type="text" name="telegram_username" id="telegram_username"
                                value="{{ old('telegram_username') }}"
                                class="peer w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-emerald-500 dark:focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="telegram_username"
                                class="absolute left-10 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-10 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                Username Telegram
                            </label>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: @username atau tanpa @</p>
                            @error('telegram_username')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div
                            class="flex flex-col sm:flex-row justify-end gap-3 pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('employees.index') }}"
                                class="group relative inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200">
                                <i class="bi bi-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                            <button type="submit"
                                class="group relative inline-flex items-center justify-center gap-2 px-8 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform group-hover:rotate-12 duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span>Simpan Pekerja</span>
                                <i class="bi bi-check-lg group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center justify-center gap-2">
                    <i class="bi bi-shield-check"></i> Data Anda aman dan terenkripsi
                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                    <i class="bi bi-clock-history"></i> Formulir baru
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-format nomor telepon (hanya angka)
            const phoneInput = document.getElementById('phone_number');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }

            // Trim whitespace pada submit
            const form = document.getElementById('employeeForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const nameInput = document.getElementById('name');
                    const skillSelect = document.getElementById('skillSelect');
                    if (nameInput) nameInput.value = nameInput.value.trim();
                    // skillSelect value tidak perlu di-trim
                });
            }

            // Menangani floating label untuk select (karena select tidak support :placeholder-shown)
            const skillSelect = document.getElementById('skillSelect');

            function toggleSkillLabel() {
                if (skillSelect.value !== '') {
                    skillSelect.classList.add('has-value');
                } else {
                    skillSelect.classList.remove('has-value');
                }
            }
            if (skillSelect) {
                skillSelect.addEventListener('change', toggleSkillLabel);
                toggleSkillLabel(); // jalankan saat load (misal old value ada)
            }

            // Untuk input biasa, tambahkan class has-value jika terisi (opsional, tapi Tailwind peer sebenarnya sudah handle)
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.value !== '') {
                    input.classList.add('has-value');
                }
                input.addEventListener('blur', function() {
                    if (this.value !== '') this.classList.add('has-value');
                    else this.classList.remove('has-value');
                });
            });
        });
    </script>

    <style>
        /* Menyesuaikan floating label untuk select yang punya class has-value */
        input.has-value~label,
        select.has-value~label {
            @apply -top-2.5 text-sm bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400;
        }

        /* Pastikan label untuk select yang tidak memiliki value tetap turun */
        select:not(.has-value)~label {
            @apply top-3.5 text-base text-gray-400;
        }

        /* Hover efek untuk select */
        select:hover {
            @apply border-emerald-300 dark:border-emerald-600;
        }
    </style>
</x-app-layout>
