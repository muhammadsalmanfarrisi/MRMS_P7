<x-app-layout>
    <x-slot name="header">Tambah Pekerjaan (Task) Baru</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border dark:border-gray-700">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">
                            Informasi Kerusakan (Opsional)</h3>

                        <div class="space-y-4">
                            {{-- <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Nama
                                    Pelapor</label>
                                <input type="text" name="reporter_name"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            </div> --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Alat/Mesin
                                    Rusak</label>
                                <input type="text" name="damaged_tool"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            </div>
                            {{-- <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Waktu
                                    Lapor</label>
                                <input type="datetime-local" name="report_time"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white [color-scheme:light] dark:[color-scheme:dark]">
                            </div> --}}
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Penyebab</label>
                                <textarea name="cause" rows="2"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Deskripsi
                                    Kerusakan</label>
                                <textarea name="description" rows="3"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Foto
                                        Kerusakan</label>
                                    <input type="file" name="photo" accept="image/*"
                                        class="w-full text-xs text-gray-500 dark:text-gray-400 file:rounded file:border-0 file:bg-gray-200 file:px-2 file:py-1 dark:file:bg-gray-700 dark:file:text-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Video
                                        (MP4)</label>
                                    <input type="file" name="video" accept="video/mp4"
                                        class="w-full text-xs text-gray-500 dark:text-gray-400 file:rounded file:border-0 file:bg-gray-200 file:px-2 file:py-1 dark:file:bg-gray-700 dark:file:text-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border dark:border-gray-700">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">
                            Detail Penugasan (Maintenance)</h3>

                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Tugaskan
                                        Kepada (Bisa Lebih Dari 1)</label>
                                    <select name="employee_ids[]" id="employee-select" multiple="multiple"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->id }}"
                                                {{ isset($task) && $task->employees->contains($worker->id) ? 'selected' : '' }}>
                                                {{ $worker->name }} ({{ $worker->skill }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Target
                                        Selesai (Deadline)</label>
                                    <input type="datetime-local" name="deadline"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white [color-scheme:light] dark:[color-scheme:dark]">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Waktu
                                        Pengerjaan (Eksekusi)</label>
                                    <input type="datetime-local" name="execution_time"
                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white [color-scheme:light] dark:[color-scheme:dark]">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Instruksi
                                    Kerja</label>
                                <textarea name="instructions" rows="2"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Kebutuhan
                                    Material/Spare Part</label>
                                <textarea name="materials_needed" rows="2"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Catatan
                                    Tambahan</label>
                                <textarea name="additional_info" rows="2"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border dark:border-gray-700 mt-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                    <i class="bi bi-list-check mr-2"></i>Detailed Instructions (SOP Steps)
                                </h3>

                                <div id="instruction-steps-container" class="space-y-3">
                                    @if (isset($task) && $task->detail_instructions->count() > 0)
                                        @foreach ($task->detail_instructions as $instruction)
                                            <div class="flex gap-2">
                                                <input type="text" name="steps[]"
                                                    value="{{ $instruction->instruction_step }}"
                                                    class="flex-1 rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                                <button type="button" onclick="this.parentElement.remove()"
                                                    class="text-red-500"><i class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex gap-2">
                                            <input type="text" name="steps[]"
                                                placeholder="Step 1: Check power supply..."
                                                class="flex-1 rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                        </div>
                                    @endif
                                </div>





                                <button type="button" id="add-step"
                                    class="mt-3 text-sm text-blue-600 dark:text-blue-400 font-bold">
                                    + Add Another Step
                                </button>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border dark:border-gray-700 mt-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                    <i class="bi bi-box-seam mr-2"></i>Materials & Spare Parts
                                </h3>

                                <div id="material-container" class="space-y-3">
                                    @if (isset($task) && $task->materials->count() > 0)
                                        @foreach ($task->materials as $material)
                                            <div class="flex gap-4 items-start">
                                                <div class="flex-1">
                                                    <input type="text" name="material_names[]"
                                                        value="{{ $material->material_name }}"
                                                        placeholder="Material Name"
                                                        class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                                </div>
                                                <div class="w-32">
                                                    <input type="text" name="material_quantities[]"
                                                        value="{{ $material->quantity }}" placeholder="Qty"
                                                        class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                                </div>
                                                <button type="button" onclick="this.parentElement.remove()"
                                                    class="text-red-500 pt-2"><i class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex gap-4 items-start">
                                            <div class="flex-1">
                                                <input type="text" name="material_names[]"
                                                    placeholder="Contoh: Bearing 6205"
                                                    class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                            </div>
                                            <div class="w-32">
                                                <input type="text" name="material_quantities[]"
                                                    placeholder="Qty (Pcs/Ltr)"
                                                    class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <button type="button" id="add-material"
                                    class="mt-3 text-sm text-green-600 dark:text-green-400 font-bold">
                                    + Add More Material
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div
                    class="flex justify-end gap-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border dark:border-gray-700">
                    <a href="{{ route('tasks.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-5 rounded-lg">Batal</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Simpan
                        Pekerjaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#employee-select').select2({
                placeholder: "Cari dan pilih pekerja...",
                allowClear: true,
                width: '100%'
            });
        });

        // Script untuk tambah baris input secara dinamis
        document.getElementById('add-step').addEventListener('click', function() {
            const container = document.getElementById('instruction-steps-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 mt-2';
            div.innerHTML = `
            <input type="text" name="steps[]" placeholder="Next step..." class="flex-1 rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500"><i class="bi bi-trash"></i></button>
        `;
            container.appendChild(div);
        });
    </script>
    <script>
        // Script untuk tambah baris material secara dinamis
        document.getElementById('add-material').addEventListener('click', function() {
            const container = document.getElementById('material-container');
            const div = document.createElement('div');
            div.className = 'flex gap-4 items-start mt-3';
            div.innerHTML = `
            <div class="flex-1">
                <input type="text" name="material_names[]" placeholder="Material Name" class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
            </div>
            <div class="w-32">
                <input type="text" name="material_quantities[]" placeholder="Qty" class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 pt-2"><i class="bi bi-trash"></i></button>
        `;
            container.appendChild(div);
        });
    </script>
</x-app-layout>
