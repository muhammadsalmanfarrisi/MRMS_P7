<x-app-layout>
    <x-slot name="header">
        {{-- Header Premium untuk Tugas Overdue --}}
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <div
                class="absolute inset-0 bg-gradient-to-r from-red-600 via-orange-500 to-amber-500 opacity-90 dark:opacity-95">
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
                                <i class="bi bi-exclamation-triangle-fill text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                                {{ __('Tugas Melewati Deadline') }}
                            </h2>
                            <span
                                class="px-3 py-1 bg-red-900/30 backdrop-blur rounded-full text-xs font-semibold text-white border border-white/30">
                                <i class="bi bi-clock-fill mr-1"></i> Overdue
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-3 text-white/90 text-sm">
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-exclamation-diamond"></i>
                                <span>Total Overdue: <strong
                                        class="text-white">{{ $overdueTasks->count() }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clock-history"></i>
                                <span>Sekarang: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('tasks.index') }}"
                        class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 bg-white text-red-700 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-red-100 to-orange-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <i
                            class="bi bi-arrow-left-circle text-lg relative z-10 group-hover:-translate-x-1 transition-transform duration-300"></i>
                        <span class="relative z-10">Kembali ke Semua Pekerjaan</span>
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
                    class="absolute -top-24 -right-24 w-64 h-64 bg-orange-300 dark:bg-orange-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-red-300 dark:bg-red-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>

                {{-- Toolbar DataTables premium --}}
                <div
                    class="relative p-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-orange-500 dark:text-orange-400 text-lg"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Data Tugas Overdue</span>
                        <span
                            class="text-xs bg-orange-100 dark:bg-orange-900/50 text-orange-700 dark:text-orange-300 px-2 py-0.5 rounded-full">{{ $overdueTasks->count() }}
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

                {{-- Keterangan singkat --}}
                <div
                    class="px-4 py-3 bg-orange-50/50 dark:bg-orange-900/20 border-b border-orange-200 dark:border-orange-800/50">
                    <p class="text-sm text-orange-800 dark:text-orange-200 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill"></i>
                        Menampilkan tugas yang <strong>waktu deadlinenya sudah terlewati</strong> (kurang dari sekarang)
                        dan <strong>belum selesai</strong>.
                    </p>
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
                            @forelse ($overdueTasks as $task)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-orange-50/50 dark:hover:bg-orange-900/20 transition-all duration-200 group">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-white text-xs font-bold shadow-md">
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
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border-blue-200',
                                                ],
                                                'worked_on' => [
                                                    'label' => 'Sedang Dikerjakan',
                                                    'color' =>
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 border-yellow-200',
                                                ],
                                                'progress_report' => [
                                                    'label' => 'Laporan Progress',
                                                    'color' =>
                                                        'bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300 border-purple-200',
                                                ],
                                                'finished' => [
                                                    'label' => 'Selesai Dikerjakan',
                                                    'color' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400 border-green-200',
                                                ],
                                                'Completed' => [
                                                    'label' => 'Completed',
                                                    'color' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400 border-green-200',
                                                ],
                                                'In Progress' => [
                                                    'label' => 'In Progress',
                                                    'color' =>
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border-blue-200',
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
                                            <div
                                                class="flex items-center gap-1 text-red-600 dark:text-red-400 font-medium">
                                                <i class="bi bi-calendar-x text-sm"></i>
                                                <span
                                                    class="text-sm">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i') }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('tasks.show', $task->id) }}?from=overdue"
                                                class="p-2 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 hover:bg-cyan-200 dark:hover:bg-cyan-800/50 transition-all duration-200"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye-fill text-sm"></i>
                                            </a>
                                            <a href="{{ route('tasks.edit', $task->id) }}?from=overdue"
                                                class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 dark:hover:bg-amber-800/50 transition-all duration-200"
                                                title="Edit Pekerjaan">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </a>
                                            <button
                                                onclick="openDeleteModal({{ $task->id }}, '{{ addslashes($task->damaged_tool ?? 'Pekerjaan ini') }}')"
                                                class="p-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/50 transition-all duration-200"
                                                title="Hapus Pekerjaan">
                                                <i class="bi bi-trash3 text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center gap-2">
                                            <i class="bi bi-emoji-smile text-3xl text-green-400"></i>
                                            <span class="text-lg font-medium">Tidak ada tugas yang melewati
                                                deadline!</span>
                                            <span class="text-sm">Semua pekerjaan sudah selesai tepat waktu.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
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
                        class="px-5 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">Batal</button>
                    <button type="submit"
                        class="px-5 py-2 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium shadow-md transition-all duration-200 flex items-center gap-2"><i
                            class="bi bi-trash3"></i> Hapus</button>
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
        // Fungsi Modal Hapus khusus overdue
        function openDeleteModal(id, name) {
            document.getElementById('deleteTaskName').innerText = name;
            document.getElementById('deleteForm').action = '/tasks/' + id + '?redirect=overdue';
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
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF',
                        className: 'btn-pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer-fill me-1"></i> Cetak',
                        className: 'btn-print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
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
                    emptyTable: "Tidak ada tugas overdue"
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

            $('#refreshTable').on('click', () => location.reload());
        });
    </script>

    <style>
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
            border: none !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-excel {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
        }

        .btn-excel:hover {
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-pdf {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            color: white !important;
        }

        .btn-pdf:hover {
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .btn-print {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: white !important;
        }

        .btn-print:hover {
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
    </style>
</x-app-layout>
