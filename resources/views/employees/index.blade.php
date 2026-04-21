<x-app-layout>
    <x-slot name="header">
        {{-- Header Premium dengan efek blur, gradien, dan statistik --}}
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            {{-- Background gradient dinamis --}}
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 opacity-90 dark:opacity-95">
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
                                <i class="bi bi-people-fill text-white text-2xl"></i>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                                {{ __('Manajemen Pekerja') }}
                            </h2>
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold text-white border border-white/30">
                                <i class="bi bi-database mr-1"></i> Real-time
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-3 text-white/90 text-sm">
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-person-check"></i>
                                <span>Total Pekerja: <strong
                                        class="text-white">{{ $employees->count() }}</strong></span>
                            </div>
                            <div class="flex items-center gap-1 bg-black/20 px-3 py-1 rounded-full">
                                <i class="bi bi-clock-history"></i>
                                <span>Terakhir diperbarui: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Tambah Pekerja dengan efek mewah --}}
                    <a href="{{ route('employees.create') }}"
                        class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 bg-white text-indigo-700 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-indigo-100 to-purple-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <i
                            class="bi bi-plus-circle text-lg relative z-10 group-hover:rotate-90 transition-transform duration-300"></i>
                        <span class="relative z-10">Tambah Pekerja Baru</span>
                        <i
                            class="bi bi-arrow-right-short text-xl relative z-10 group-hover:translate-x-1 transition-transform"></i>
                    </a>
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
                    class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-300 dark:bg-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>
                <div
                    class="absolute -bottom-32 -left-20 w-72 h-72 bg-purple-300 dark:bg-purple-700 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-30">
                </div>

                {{-- Toolbar DataTables premium (di dalam card) --}}
                <div
                    class="relative p-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-indigo-500 dark:text-indigo-400 text-lg"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Data Pekerja</span>
                        <span
                            class="text-xs bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-full">{{ $employees->count() }}
                            record</span>
                    </div>

                </div>

                {{-- Tabel dengan styling modern --}}
                <div class="overflow-x-auto relative">
                    <table id="employeesTable" class="min-w-full text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-50/80 dark:bg-gray-900/50 backdrop-blur-sm">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-4 px-4 text-left font-semibold text-sm">Nama</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Keahlian</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">No. Telepon</th>
                                <th class="py-4 px-4 text-left font-semibold text-sm">Telegram</th>
                                <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-all duration-200 group">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                                            </div>
                                            <span class="font-medium">{{ $employee->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            $skillColors = [
                                                'Teknisi Mekanik' =>
                                                    'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
                                                'Teknisi Listrik' =>
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                                'Maintenance Gedung' =>
                                                    'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300',
                                                'Teknisi IT' =>
                                                    'bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300',
                                                'Lainnya' =>
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                            ];
                                            $color =
                                                $skillColors[$employee->skill] ??
                                                'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $color }}">
                                            <i class="bi bi-tools mr-1 text-xs"></i> {{ $employee->skill }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($employee->phone_number)
                                            <a href="tel:{{ $employee->phone_number }}"
                                                class="flex items-center gap-1 hover:text-indigo-600 transition">
                                                <i class="bi bi-telephone-fill text-gray-400 text-sm"></i>
                                                {{ $employee->phone_number }}
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($employee->telegram_username)
                                            <a href="https://t.me/{{ ltrim($employee->telegram_username, '@') }}"
                                                target="_blank"
                                                class="flex items-center gap-1 text-sky-600 hover:text-sky-800 dark:text-sky-400 transition">
                                                <i class="bi bi-telegram"></i> {{ $employee->telegram_username }}
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 dark:hover:bg-amber-800/50 transition-all duration-200 group/edit"
                                                title="Edit Pekerja">
                                                <i
                                                    class="bi bi-pencil-square text-sm group-hover/edit:scale-110 transition-transform"></i>
                                            </a>
                                            <button
                                                onclick="openDeleteModal({{ $employee->id }}, '{{ addslashes($employee->name) }}')"
                                                class="p-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800/50 transition-all duration-200 group/del"
                                                title="Hapus Pekerja">
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
                    Apakah Anda yakin ingin menghapus pekerja <strong id="deleteEmployeeName"
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
            document.getElementById('deleteEmployeeName').innerText = name;
            document.getElementById('deleteForm').action = `/employees/${id}`;
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
            const table = $('#employeesTable').DataTable({
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
                    const $thead = $('#employeesTable thead');
                    const $searchRow = $('<tr class="column-search-row">\</tr>');

                    // Loop setiap kolom pada header utama
                    $thead.find('tr:first th').each(function(i) {
                        const title = $(this).text().trim();
                        const lowerTitle = title.toLowerCase();
                        // Kolom Aksi (indeks 4) tidak perlu search
                        if (lowerTitle === 'aksi' || i === 4) {
                            $searchRow.append('<th></th>');
                        } else {
                            $searchRow.append(`
                <th>
                    <input type="text" 
                           placeholder="Cari ${title}" 
                           class="w-full rounded-lg px-3 py-1.5 text-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                </th>
            `);
                        }
                    });

                    $thead.append($searchRow);

                    // Event listener untuk setiap input search per kolom
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
                    emptyTable: "Belum ada data pekerja"
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
                    // Menambahkan placeholder pada search box
                    $('.dataTables_filter input').attr('placeholder', 'Cari nama, keahlian...')
                        .addClass('rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700');
                    $('.dataTables_length select').addClass(
                        'rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700');
                }
            });

            // Tombol refresh
            $('#refreshTable').on('click', function() {
                table.ajax.reload();
                $(this).addClass('animate-spin');
                setTimeout(() => $(this).removeClass('animate-spin'), 500);
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
            @apply px-3 py-1 rounded-lg mx-1 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-indigo-600 text-white hover:bg-indigo-700;
        }

        .dark .dataTables_wrapper .dataTables_info {
            @apply text-gray-400;
        }

        /* Hapus border default DataTables */
        table.dataTable.no-footer {
            border-bottom: none;
        }

        /* Animasi untuk refresh button */
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

        /* Efek klik */
        .btn-excel:active,
        .btn-pdf:active,
        .btn-print:active {
            transform: translateY(1px);
        }
    </style>
</x-app-layout>
