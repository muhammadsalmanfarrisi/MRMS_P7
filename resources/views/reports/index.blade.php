<x-app-layout>
    <x-slot name="header">
        {{-- Header Premium dengan efek blur, gradien, dan statistik --}}
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            {{-- Background gradient dinamis --}}
            <div
                class="absolute inset-0 bg-gradient-to-r from-rose-600 via-orange-600 to-amber-600 opacity-90 dark:opacity-95">
            </div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff"
                fill-opacity="0.08"%3E%3Cpath
                d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

            <div class="relative px-6 py-6 md:px-8 md:py-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    {{-- Bagian kiri: judul + statistik --}}
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-white/20 backdrop-blur rounded-xl shadow-lg">
                                <i class="bi bi-exclamation-triangle-fill text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                                {{ __('Daftar Laporan Kerusakan') }}
                            </h2>
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold text-white border border-white/30">
                                <i class="bi bi-database mr-1"></i> Real-time
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-3 text-white/90 text-sm">
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clipboard-check"></i>
                                <span>Total Laporan: <strong class="text-white">{{ $reports->count() }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clock-history"></i>
                                <span>Terakhir diperbarui: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        {{-- Card utama dengan efek glassmorphism --}}
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden transition-all duration-500">
            <div class="relative">
                {{-- Decorative blur elements --}}
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-rose-300 dark:bg-rose-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-amber-300 dark:bg-amber-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>

                {{-- Toolbar DataTables premium (di dalam card) --}}
                <div
                    class="relative p-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-rose-500 dark:text-rose-400 text-lg"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Data Laporan Kerusakan</span>
                        <span
                            class="text-xs bg-rose-100 dark:bg-rose-900/50 text-rose-700 dark:text-rose-300 px-2 py-0.5 rounded-full">{{ $reports->count() }}
                            record</span>
                    </div>
                </div>

                {{-- Tabel dengan styling modern --}}
                <div class="overflow-x-auto relative">
                    <table id="reportsTable" class="min-w-full text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-50/80 dark:bg-gray-900/50 backdrop-blur-sm">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-4 px-4 text-left font-semibold text-sm">Waktu & Pelapor</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Mesin/Alat</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Status</th>
                                <th class="py-4 px-4 text-center font-semibold text-sm">Lampiran</th>
                                <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-rose-50/50 dark:hover:bg-rose-900/20 transition-all duration-200 group">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-rose-500 to-amber-500 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                                {{ strtoupper(substr($report->reporter_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white">
                                                    {{ \Carbon\Carbon::parse($report->report_time)->format('d M Y, H:i') }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Oleh:
                                                    {{ $report->reporter_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 font-medium">{{ $report->damaged_tool }}</td>
                                    <td class="py-3 px-4">
                                        @php
                                            $colorMap = [
                                                'unprocessed' => [
                                                    'bg' => '#fee2e2', // merah sangat muda
                                                    'text' => '#991b1b', // merah gelap
                                                    'border' => '#fecaca', // merah muda
                                                    'label' => 'Belum di Proses',
                                                ],
                                                'processed' => [
                                                    'bg' => '#dbeafe',
                                                    'text' => '#1e40af',
                                                    'border' => '#bfdbfe',
                                                    'label' => 'Sedang di Proses',
                                                ],
                                                'worked_on' => [
                                                    'bg' => '#fef3c7',
                                                    'text' => '#92400e',
                                                    'border' => '#fde68a',
                                                    'label' => 'Sedang Dikerjakan',
                                                ],
                                                'finished' => [
                                                    'bg' => '#d1fae5',
                                                    'text' => '#065f46',
                                                    'border' => '#a7f3d0',
                                                    'label' => 'Selesai Dikerjakan',
                                                ],
                                                'Completed' => [
                                                    'bg' => '#d1fae5',
                                                    'text' => '#065f46',
                                                    'border' => '#a7f3d0',
                                                    'label' => 'Completed',
                                                ],
                                                'In Progress' => [
                                                    'bg' => '#dbeafe',
                                                    'text' => '#1e40af',
                                                    'border' => '#bfdbfe',
                                                    'label' => 'In Progress',
                                                ],
                                                'belum di proses' => [
                                                    'bg' => '#f3f4f6',
                                                    'text' => '#1f2937',
                                                    'border' => '#d1d5db',
                                                    'label' => 'Belum di Proses',
                                                ],
                                            ];
                                            $badge = $colorMap[$report->status] ?? [
                                                'bg' => '#f3f4f6',
                                                'text' => '#1f2937',
                                                'border' => '#d1d5db',
                                                'label' => ucfirst($report->status),
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border"
                                            style="background-color: {{ $badge['bg'] }}; color: {{ $badge['text'] }}; border-color: {{ $badge['border'] }};">
                                            <i class="bi bi-circle-fill mr-1" style="font-size: 6px;"></i>
                                            {{ $badge['label'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if ($report->photo_url)
                                                <a href="{{ asset('storage/' . $report->photo_url) }}" target="_blank"
                                                    class="p-1.5 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-800/50 transition"
                                                    title="Lihat Foto">
                                                    <i class="bi bi-image text-sm"></i>
                                                </a>
                                            @endif
                                            @if ($report->video_url)
                                                <a href="{{ asset('storage/' . $report->video_url) }}" target="_blank"
                                                    class="p-1.5 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/50 transition"
                                                    title="Lihat Video">
                                                    <i class="bi bi-play-btn text-sm"></i>
                                                </a>
                                            @endif
                                            @if (!$report->photo_url && !$report->video_url)
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Tombol Tindak Lanjut (UTAMA) --}}

                                            <a href="{{ route('tasks.edit', $report->id) }}"
                                                class="group/tindak relative overflow-hidden inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5"
                                                title="Tindak Lanjuti Laporan">
                                                <i
                                                    class="bi bi-arrow-right-circle-fill text-sm group-hover/tindak:translate-x-0.5 transition-transform"></i>
                                                <span class="text-sm">Tindak Lanjut</span>
                                            </a>




                                            {{-- Tombol Hapus --}}
                                            <button
                                                onclick="openDeleteModal({{ $report->id }}, '{{ addslashes($report->damaged_tool) }}')"
                                                class="p-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/50 transition-all duration-200 group/del"
                                                title="Hapus Laporan">
                                                <i
                                                    class="bi bi-trash3 text-sm group-hover/del:scale-110 transition-transform"></i>
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

    {{-- Modal Hapus Premium dengan Animasi --}}
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
                    Apakah Anda yakin ingin menghapus laporan <strong id="deleteReportName"
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

    {{-- DataTables & Dependencies --}}
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
        // Modal functions with animation
        function openDeleteModal(id, name) {
            document.getElementById('deleteReportName').innerText = name;
            document.getElementById('deleteForm').action = `/reports/${id}`;
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
            // Inisialisasi DataTables dengan tema kustom
            const table = $('#reportsTable').DataTable({
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
                initComplete: function() {
                    const api = this.api();
                    const $thead = $('#reportsTable thead');
                    const $searchRow = $('<tr class="column-search-row"></tr>');

                    $thead.find('tr:first th').each(function(i) {
                        const title = $(this).text().trim();
                        if (title === 'Aksi' || i === 4) {
                            $searchRow.append('<th></th>');
                        } else {
                            $searchRow.append(`
                                <th>
                                    <input type="text" placeholder="Cari ${title}" 
                                           class="w-full rounded-lg px-3 py-1.5 text-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-rose-500 focus:border-transparent transition" />
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
                    emptyTable: "Belum ada data laporan"
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: [4],
                    orderable: false,
                    searchable: false
                }]
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
            @apply px-3 py-1 rounded-lg mx-1 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-rose-600 text-white hover:bg-rose-700;
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
    </style>
    <style>
        /* Badge status dasar */
        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.25;
            border-width: 1px;
            border-style: solid;
            transition: all 0.2s;
        }

        .badge-status i {
            margin-right: 0.25rem;
            font-size: 0.6rem;
        }

        /* Warna untuk setiap status */
        .status-unprocessed {
            background-color: #f3f4f6;
            color: #1f2937;
            border-color: #d1d5db;
        }

        .status-processed,
        .status-in-progress {
            background-color: #dbeafe;
            color: #1e40af;
            border-color: #bfdbfe;
        }

        .status-worked-on {
            background-color: #fef3c7;
            color: #92400e;
            border-color: #fde68a;
        }

        .status-finished,
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .status-belum-di-proses {
            background-color: #f3f4f6;
            color: #1f2937;
            border-color: #d1d5db;
        }

        /* Dark mode (opsional, jika body punya kelas .dark) */
        .dark .status-unprocessed {
            background-color: #1f2937;
            color: #9ca3af;
            border-color: #374151;
        }

        .dark .status-processed,
        .dark .status-in-progress {
            background-color: #1e3a8a;
            color: #93c5fd;
            border-color: #1e40af;
        }

        .dark .status-worked-on {
            background-color: #78350f;
            color: #fde68a;
            border-color: #b45309;
        }

        .dark .status-finished,
        .dark .status-completed {
            background-color: #064e3b;
            color: #6ee7b7;
            border-color: #047857;
        }

        .dark .status-belum-di-proses {
            background-color: #1f2937;
            color: #9ca3af;
            border-color: #374151;
        }
    </style>
</x-app-layout>
