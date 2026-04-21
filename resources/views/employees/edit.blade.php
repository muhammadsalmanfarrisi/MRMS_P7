<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 opacity-10"></div>
            <div class="relative flex items-center gap-3">
                <div class="p-2 bg-white/20 dark:bg-gray-800/30 backdrop-blur rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-600 dark:text-amber-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h2
                    class="text-2xl font-bold bg-gradient-to-r from-amber-700 to-orange-700 dark:from-amber-300 dark:to-orange-300 bg-clip-text text-transparent">
                    {{ __('Edit Data Pekerja') }}
                </h2>
                <span
                    class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/60 dark:text-amber-200">
                    <i class="bi bi-pencil-square mr-1"></i> Mode Edit
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Card Utama dengan efek glassmorphism --}}
            <div
                class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 transition-all duration-500">
                {{-- Decorative background elements --}}
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-amber-300 dark:bg-amber-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-orange-300 dark:bg-orange-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-20">
                </div>

                <div class="relative p-6 md:p-8">
                    {{-- Header card dengan icon dan informasi pekerja --}}
                    <div
                        class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Informasi Pekerja</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Perbarui data pekerja dengan teliti
                                </p>
                            </div>
                        </div>

                    </div>

                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" id="employeeForm"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Floating label untuk Nama --}}
                        <div class="relative group">
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $employee->name) }}" required
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-amber-500 dark:focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="name"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-amber-600 dark:peer-focus:text-amber-400">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1"><i
                                        class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Keahlian dengan floating label (sama seperti kolom Nama) --}}
                        <div class="relative group">
                            <select name="skill" id="skillSelect"
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-amber-500 dark:focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all duration-300 appearance-none"
                                required>
                                <option value=""> </option>
                                <option value="Teknisi Mekanik"
                                    {{ old('skill', $employee->skill) == 'Teknisi Mekanik' ? 'selected' : '' }}>Teknisi
                                    Mekanik</option>
                                <option value="Teknisi Listrik"
                                    {{ old('skill', $employee->skill) == 'Teknisi Listrik' ? 'selected' : '' }}>Teknisi
                                    Listrik</option>
                                <option value="Maintenance Gedung"
                                    {{ old('skill', $employee->skill) == 'Maintenance Gedung' ? 'selected' : '' }}>
                                    Maintenance Gedung</option>
                                <option value="Teknisi IT"
                                    {{ old('skill', $employee->skill) == 'Teknisi IT' ? 'selected' : '' }}>Teknisi IT
                                </option>
                                <option value="Lainnya"
                                    {{ old('skill', $employee->skill) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <label for="skillSelect"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-amber-600 dark:peer-focus:text-amber-400">
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

                        {{-- No Telepon dengan format otomatis --}}
                        <div class="relative group">
                            <input type="tel" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $employee->phone_number) }}"
                                class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-amber-500 dark:focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="phone_number"
                                class="absolute left-4 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-4 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-amber-600 dark:peer-focus:text-amber-400">
                                No. Telepon
                            </label>
                            <div class="absolute right-3 top-3 text-gray-400">
                                <i class="bi bi-phone"></i>
                            </div>
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Telegram Username dengan prefix @ --}}
                        <div class="relative group">
                            <div class="absolute left-4 top-3.5 text-gray-500 dark:text-gray-400 z-10">
                                <i class="bi bi-telegram"></i>
                            </div>
                            <input type="text" name="telegram_username" id="telegram_username"
                                value="{{ old('telegram_username', $employee->telegram_username) }}"
                                class="peer w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-amber-500 dark:focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all duration-300"
                                placeholder=" ">
                            <label for="telegram_username"
                                class="absolute left-10 -top-2.5 bg-white dark:bg-gray-800 px-1 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-placeholder-shown:left-10 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-amber-600 dark:peer-focus:text-amber-400">
                                Username Telegram
                            </label>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: @username atau tanpa @</p>
                            @error('telegram_username')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol aksi dengan efek 3D --}}
                        <div
                            class="flex flex-col sm:flex-row justify-end gap-3 pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('employees.index') }}"
                                class="group relative inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200 overflow-hidden">
                                <i class="bi bi-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                            <button type="submit"
                                class="group relative inline-flex items-center justify-center gap-2 px-8 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-95 overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform group-hover:rotate-12 duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Update Data</span>
                                <i class="bi bi-check-lg group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info tambahan dengan desain menarik --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center justify-center gap-2">
                    <i class="bi bi-shield-check"></i> Data Anda aman dan terenkripsi
                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                    <i class="bi bi-clock-history"></i> Terakhir diperbarui:
                    {{ $employee->updated_at->diffForHumans() ?? 'baru saja' }}
                </p>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk validasi real-time dan efek --}}
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
                    const skillInput = document.getElementById('skill');
                    if (nameInput) nameInput.value = nameInput.value.trim();
                    if (skillInput) skillInput.value = skillInput.value.trim();
                });
            }

            // Efek floating label untuk nilai awal (karena input sudah terisi)
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
        $(document).ready(function() {
            // Inisialisasi Select2 dengan tema modern
            $('#skillSelect').select2({
                theme: 'classic', // bisa ganti 'default' jika ingin style lebih sederhana
                width: '100%',
                placeholder: 'Pilih keahlian',
                allowClear: true,
                dropdownCssClass: 'rounded-xl shadow-lg',
                containerCssClass: 'rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-900/50'
            });
        });
        // Menangani floating label untuk select (karena select tidak support :placeholder-shown)
        document.addEventListener('DOMContentLoaded', function() {
            const skillSelect = document.getElementById('skillSelect');

            function toggleSkillLabel() {
                if (skillSelect.value !== '') {
                    skillSelect.classList.add('has-value');
                } else {
                    skillSelect.classList.remove('has-value');
                }
            }
            skillSelect.addEventListener('change', toggleSkillLabel);
            toggleSkillLabel(); // jalankan saat load
        });
    </script>

    <style>
        /* Menyesuaikan floating label jika input terisi */
        input:not(:placeholder-shown)~label,
        input.has-value~label {
            @apply -top-2.5 text-sm bg-white dark:bg-gray-800 text-amber-600 dark:text-amber-400;
        }

        /* Untuk browser yang support :placeholder-shown */
        input:placeholder-shown~label {
            @apply top-3.5 text-base text-gray-400;
        }

        /* Agar label tetap naik jika select memiliki class has-value */
        input.has-value~label,
        select.has-value~label {
            @apply -top-2.5 text-sm bg-white dark:bg-gray-800 text-amber-600 dark:text-amber-400;
        }
    </style>
</x-app-layout>
