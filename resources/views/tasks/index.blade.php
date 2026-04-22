<x-app-layout>
    <x-slot name="header">
        {{-- Header Premium dengan efek blur, gradien, dan statistik --}}
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
                                <i class="bi bi-tools text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                                {{ __('Daftar Pekerjaan Maintenance') }}
                            </h2>
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold text-white border border-white/30">
                                <i class="bi bi-database mr-1"></i> Real-time
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-3 text-white/90 text-sm">
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clipboard-check"></i>
                                <span>Total Pekerjaan: <strong class="text-white">{{ $tasks->count() }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clock-history"></i>
                                <span>Terakhir diperbarui: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('tasks.create') }}"
                        class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 bg-white text-cyan-700 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-cyan-100 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <i
                            class="bi bi-plus-circle text-lg relative z-10 group-hover:rotate-90 transition-transform duration-300"></i>
                        <span class="relative z-10">Tambah Pekerjaan Baru</span>
                        <i
                            class="bi bi-arrow-right-short text-xl relative z-10 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden transition-all duration-500">
            <div class="relative">
                {{-- Decorative blur elements --}}
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-blue-300 dark:bg-blue-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-cyan-300 dark:bg-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>

                {{-- Toolbar DataTables premium --}}
                <div
                    class="relative p-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-cyan-500 dark:text-cyan-400 text-lg"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Data Pekerjaan</span>
                        <span
                            class="text-xs bg-cyan-100 dark:bg-cyan-900/50 text-cyan-700 dark:text-cyan-300 px-2 py-0.5 rounded-full">{{ $tasks->count() }}
                            record</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button id="refreshTable"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all"
                            title="Refresh Data">
                            <i class="bi bi-arrow-repeat text-lg"></i>
                        </button>
                    </div>
                </div>
                {{-- Filter Tanggal Premium dengan Auto-Submit --}}
                <div
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-white/90 via-white/80 to-cyan-50/60 dark:from-gray-800/90 dark:via-gray-800/80 dark:to-cyan-900/30 backdrop-blur-md shadow-xl border border-white/30 dark:border-gray-700/50 mb-6 transition-all duration-500 group">
                    {{-- Decorative Background --}}
                    <div
                        class="absolute -top-10 -right-10 w-40 h-40 bg-blue-400/20 dark:bg-blue-600/20 rounded-full blur-3xl">
                    </div>
                    <div
                        class="absolute -bottom-10 -left-10 w-40 h-40 bg-cyan-400/20 dark:bg-cyan-600/20 rounded-full blur-3xl">
                    </div>

                    <div class="relative p-5 md:p-6">
                        <form method="GET" action="{{ route('tasks.index') }}" id="filterForm"
                            class="flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                            {{-- Label & Input Date --}}
                            <div class="flex-1 space-y-2">
                                <label for="date"
                                    class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <span
                                        class="p-1.5 bg-blue-100 dark:bg-blue-900/40 rounded-lg text-blue-600 dark:text-blue-400">
                                        <i class="far fa-calendar-alt text-sm"></i>
                                    </span>
                                    <span>Filter Deadline Tugas</span>
                                </label>

                                {{-- Container Input Date Premium --}}
                                <div class="relative group/date">
                                    {{-- Glow effect background --}}
                                    <div
                                        class="absolute -inset-0.5 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl opacity-0 group-hover/date:opacity-100 blur transition duration-500">
                                    </div>

                                    <div class="relative">
                                        {{-- Icon Calendar Kiri --}}
                                        <div
                                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                            <i
                                                class="far fa-calendar-alt text-lg text-transparent bg-clip-text bg-gradient-to-br from-cyan-500 to-blue-600 dark:from-cyan-400 dark:to-blue-400"></i>
                                        </div>

                                        {{-- Input Date --}}
                                        <input type="text" name="date" id="datepicker"
                                            onchange="document.getElementById('filterForm').submit();"
                                            class="w-full pl-12 pr-12 py-3.5 
                      bg-white/90 dark:bg-gray-900/90 
                      backdrop-blur-sm
                      border-2 border-gray-200 dark:border-gray-700 
                      rounded-xl 
                      text-gray-800 dark:text-white 
                      text-sm font-medium
                      shadow-[0_8px_20px_-6px_rgba(0,0,0,0.1)] dark:shadow-[0_8px_20px_-6px_rgba(0,0,0,0.4)]
                      focus:outline-none focus:border-transparent
                      focus:ring-4 focus:ring-cyan-400/30 dark:focus:ring-cyan-600/30
                      hover:border-cyan-300 dark:hover:border-cyan-700
                      transition-all duration-300 
                      cursor-pointer
                      appearance-none
                      date-input-custom"
                                            value="{{ $selectedDate }}">

                                        {{-- Icon Dropdown Kanan (Chevron) --}}
                                        <div
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                                            <i
                                                class="fas fa-chevron-down text-xs text-cyan-500 dark:text-cyan-400 opacity-70 group-hover/date:opacity-100 transition"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                    <i class="far fa-info-circle"></i>
                                    Klik ikon kalender untuk pilih tanggal, data akan langsung diperbarui otomatis.
                                </p>
                            </div>

                            {{-- Tombol Hari Ini & Indikator Tanggal Aktif --}}
                            <div class="flex flex-row md:flex-col items-center md:items-end gap-3">
                                <a href="{{ route('tasks.index') }}"
                                    class="group relative inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:shadow-md hover:border-cyan-300 dark:hover:border-cyan-700 transition-all duration-200">
                                    <i
                                        class="fas fa-calendar-day text-cyan-600 dark:text-cyan-400 group-hover:scale-110 transition-transform"></i>
                                    <span>Hari Ini</span>
                                </a>

                                <div class="flex items-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-950/50 dark:to-cyan-950/50 backdrop-blur-sm rounded-full text-xs font-medium text-blue-800 dark:text-blue-300 border border-blue-200/60 dark:border-blue-800/60 shadow-sm">
                                        <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                                        <span>Deadline:</span>
                                        <strong>{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </form>

                        {{-- Tampilkan pesan jika tidak ada data (opsional, bisa ditambahkan di bawah tabel) --}}
                    </div>
                </div>
                {{-- Tabel dengan DataTables --}}
                <div class="overflow-x-auto relative">
                    <table id="tasksTable" class="min-w-full text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-50/80 dark:bg-gray-900/50 backdrop-blur-sm">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-4 px-4 text-left font-semibold text-sm">Alat/Mesin</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Mekanik (PIC)</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Status</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Deadline</th>
                                <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-cyan-50/50 dark:hover:bg-cyan-900/20 transition-all duration-200 group">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                                <i class="bi bi-wrench text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white">
                                                    {{ $task->damaged_tool ?? 'Tidak disebutkan' }}</div>
                                                <div class="text-xs text-gray-500">Pelapor:
                                                    {{ $task->reporter_name ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($task->employees->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($task->employees as $emp)
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-300 text-xs px-2 py-1 rounded-full">
                                                        <i class="bi bi-person-circle text-[10px]"></i>
                                                        {{ $emp->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Belum Ditugaskan</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            $statusMap = [
                                                'unprocessed' => [
                                                    'label' => 'Belum di Proses',
                                                    'color' =>
                                                        'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 border-gray-300',
                                                ],
                                                'processed' => [
                                                    'label' => 'Sedang di Proses',
                                                    'color' =>
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                                                ],
                                                'worked_on' => [
                                                    'label' => 'Sedang Dikerjakan',
                                                    'color' =>
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800',
                                                ],
                                                'finished' => [
                                                    'label' => 'Selesai Dikerjakan',
                                                    'color' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400 border-green-200 dark:border-green-800',
                                                ],
                                                'Completed' => [
                                                    'label' => 'Completed',
                                                    'color' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400 border-green-200 dark:border-green-800',
                                                ],
                                                'In Progress' => [
                                                    'label' => 'In Progress',
                                                    'color' =>
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                                                ],
                                                'belum di proses' => [
                                                    'label' => 'Belum di Proses',
                                                    'color' =>
                                                        'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 border-gray-300',
                                                ],
                                            ];
                                            $status = $statusMap[$task->status] ?? [
                                                'label' => ucfirst($task->status ?? 'Pending'),
                                                'color' =>
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 border-gray-300',
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $status['color'] }}">
                                            <i class="bi bi-circle-fill mr-1 text-[6px]"></i> {{ $status['label'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($task->deadline)
                                            <div class="flex items-center gap-1">
                                                <i class="bi bi-calendar-event text-gray-400 text-sm"></i>
                                                <span
                                                    class="text-sm">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i') }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Tombol Show / Lihat Detail --}}
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="p-2 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 hover:bg-cyan-200 dark:hover:bg-cyan-800/50 transition-all duration-200"
                                                title="Lihat Detail Pekerjaan">
                                                <i class="bi bi-eye-fill text-sm"></i>
                                            </a>

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 dark:hover:bg-amber-800/50 transition-all duration-200"
                                                title="Edit Pekerjaan">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <button
                                                onclick="openDeleteModal({{ $task->id }}, '{{ addslashes($task->damaged_tool ?? 'Pekerjaan ini') }}')"
                                                class="p-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/50 transition-all duration-200"
                                                title="Hapus Pekerjaan">
                                                <i class="bi bi-trash3 text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Premium --}}
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0"
            id="deleteModalContent">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center">
                        <i class="bi bi-exclamation-triangle-fill text-red-600 dark:text-red-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Apakah Anda yakin ingin menghapus pekerjaan <strong id="deleteTaskName"
                        class="font-semibold text-red-600 dark:text-red-400"></strong>?
                    Data yang dihapus tidak dapat dikembalikan.
                </p>
                <form id="deleteForm" method="POST" class="flex justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-5 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium shadow-md transition-all duration-200 flex items-center gap-2">
                        <i class="bi bi-trash3"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- DataTables Dependencies --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
        // Modal functions
        function openDeleteModal(id, name) {
            document.getElementById('deleteTaskName').innerText = name;
            document.getElementById('deleteForm').action = `/tasks/${id}`;
            const modal = document.getElementById('deleteModal');
            const content = document.getElementById('deleteModalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const content = document.getElementById('deleteModalContent');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        $(document).ready(function() {
            // Inisialisasi DataTables
            const table = $('#tasksTable').DataTable({
                responsive: true,
                dom: "<'flex flex-col md:flex-row justify-between items-center mb-4 gap-3'<'flex items-center gap-2'B><'flex gap-2'f l>>" +
                    "<'overflow-x-auto't>" +
                    "<'flex flex-col md:flex-row justify-between items-center mt-4 gap-3'<'text-sm'i><'pagination-wrapper'p>>",
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel',
                        className: 'btn-excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button').addClass('btn-excel');
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF',
                        className: 'btn-pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button').addClass('btn-pdf');
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer-fill me-1"></i> Cetak',
                        className: 'btn-print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button').addClass('btn-print');
                        }
                    }
                ],
                initComplete: function() {
                    const api = this.api();
                    const $thead = $('#tasksTable thead');
                    const $searchRow = $('<tr class="column-search-row">\</tr>');

                    $thead.find('tr:first th').each(function(i) {
                        const title = $(this).text().trim();
                        if (i === 4) { // Kolom Aksi
                            $searchRow.append('<th></th>');
                        } else {
                            $searchRow.append(`
                                <th>
                                    <input type="text" placeholder="Cari ${title}" class="w-full rounded-lg px-3 py-1.5 text-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition">
                                </th>
                            `);
                        }
                    });

                    $thead.append($searchRow);

                    $searchRow.find('input').on('keyup change', function() {
                        const colIndex = $(this).closest('th').index();
                        if (api.column(colIndex).search() !== this.value) {
                            api.column(colIndex).search(this.value).draw();
                        }
                    });
                },
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Tidak ditemukan data yang cocok",
                    emptyTable: "Belum ada data pekerjaan"
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    targets: [4],
                    orderable: false,
                    searchable: false
                }],
                initComplete: function() {
                    $('.dataTables_filter input').attr('placeholder', 'Cari alat, mekanik, status...')
                        .addClass('rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700');
                    $('.dataTables_length select').addClass(
                        'rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700');
                }
            });

            $('#refreshTable').on('click', function() {
                table.ajax.reload();
                $(this).addClass('animate-spin');
                setTimeout(() => $(this).removeClass('animate-spin'), 500);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Flatpickr dengan konfigurasi
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d", // Format sesuai database
                defaultDate: "{{ $selectedDate }}", // Tanggal default dari controller
                theme: "material_blue", // Sesuaikan dengan CSS yang di-load
                locale: "id", // Opsional: Bahasa Indonesia (perlu file locale)
                onChange: function(selectedDates, dateStr, instance) {
                    // Saat tanggal dipilih, submit form otomatis
                    document.getElementById('filterForm').submit();
                }
            });
        });
    </script>
    <style>
        /* Custom styling untuk DataTables premium */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            @apply rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply px-3 py-1 rounded-lg mx-1 hover:bg-cyan-100 dark:hover:bg-cyan-900/50 transition;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-cyan-600 text-white hover:bg-cyan-700;
        }

        .dark .dataTables_wrapper .dataTables_info {
            @apply text-gray-400;
        }

        table.dataTable.no-footer {
            border-bottom: none;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 0.5s linear;
        }

        /* Tombol Export Premium */
        .btn-excel,
        .btn-pdf,
        .btn-print {
            display: inline-flex !important;
            align-items: center;
            gap: 6px;
            padding: 8px 16px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: none !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-excel {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
        }

        .btn-excel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        }

        .btn-pdf {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            color: white !important;
        }

        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
        }

        .btn-print {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: white !important;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        }

        .btn-excel:active,
        .btn-pdf:active,
        .btn-print:active {
            transform: translateY(1px);
        }

        /* Tambahan styling untuk badge status */
        .inline-flex.items-center.px-2\\.5.py-1.rounded-full i.bi-circle-fill {
            vertical-align: middle;
        }

        /* Sembunyikan ikon default browser pada input date */
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
            z-index: 20;
            color-scheme: light;
        }

        /* Dark mode adjustment */
        .dark input[type="date"]::-webkit-calendar-picker-indicator {
            color-scheme: dark;
            filter: invert(1);
        }

        /* Untuk Firefox */
        input[type="date"] {
            -moz-appearance: textfield;
        }

        /* Placeholder text styling */
        input[type="date"]::-webkit-datetime-edit-fields-wrapper {
            padding: 0;
        }

        input[type="date"]::-webkit-datetime-edit-text {
            color: #6b7280;
            padding: 0 0.2rem;
        }

        input[type="date"]::-webkit-datetime-edit-month-field,
        input[type="date"]::-webkit-datetime-edit-day-field,
        input[type="date"]::-webkit-datetime-edit-year-field {
            color: #1f2937;
            font-weight: 500;
            padding: 0 0.2rem;
        }

        .dark input[type="date"]::-webkit-datetime-edit-month-field,
        .dark input[type="date"]::-webkit-datetime-edit-day-field,
        .dark input[type="date"]::-webkit-datetime-edit-year-field {
            color: #f3f4f6;
        }

        /* Hover dan fokus efek tambahan */
        .date-input-custom:hover {
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1), 0 8px 20px -6px rgba(0, 0, 0, 0.15);
        }

        /* Animasi ikon kalender saat hover */
        .group\/date:hover .fa-calendar-alt {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
                color: #0284c7;
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</x-app-layout>
