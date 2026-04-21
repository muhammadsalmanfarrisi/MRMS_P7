<x-app-layout>
    <x-slot name="header">
        <div
            class="flex flex-wrap justify-between items-center gap-4 py-3 px-5 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-md border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl bg-indigo-100 dark:bg-indigo-900/50">
                    <i class="bi bi-person-badge text-indigo-600 dark:text-indigo-400 text-xl"></i>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">
                    {{ __('Daftar Pekerja') }}
                </h2>
                <div class="hidden md:block h-6 w-px bg-gray-300 dark:bg-gray-600 mx-1"></div>
                <span
                    class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full">
                    Total: {{ $employees->count() }} pekerja
                </span>
            </div>

            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl shadow-md hover:shadow-lg transition-all duration-200 font-medium">
                <i class="bi bi-plus-circle text-lg"></i>
                <span>Tambah Pekerja</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden transition-colors duration-300">
            <div class="overflow-x-auto">
                <table id="employeesTable" class="min-w-full text-gray-900 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="py-3 px-4 text-center border-r border-gray-200 dark:border-gray-700">Nama</th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 dark:border-gray-700">Keahlian
                            </th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 dark:border-gray-700">No. Telp
                            </th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 dark:border-gray-700">Telegram
                            </th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr
                                class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 transition">
                                <td class="py-3 px-4 text-center">{{ $employee->name }}</td>
                                <td class="py-3 px-4 text-center">{{ $employee->skill }}</td>
                                <td class="py-3 px-4 text-center">{{ $employee->phone_number ?? '-' }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if ($employee->telegram_username)
                                        <a href="https://t.me/{{ ltrim($employee->telegram_username, '@') }}"
                                            target="_blank" class="text-blue-500 hover:underline">
                                            {{ $employee->telegram_username }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition inline-block mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button
                                        onclick="openDeleteModal({{ $employee->id }}, '{{ addslashes($employee->name) }}')"
                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96 shadow-xl">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Yakin hapus pekerja <strong
                    id="deleteEmployeeName"></strong>?</p>
            <form id="deleteForm" method="POST" class="mt-4 flex justify-end gap-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()"
                    class="px-3 py-1 bg-gray-500 text-white rounded">Batal</button>
                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
            </form>
        </div>
    </div>

    {{-- DataTables & dependencies (jika belum ada di layout) --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('deleteEmployeeName').innerText = name;
            document.getElementById('deleteForm').action = `/employees/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').style.display = 'none';
        }

        $(document).ready(function() {
            const table = $('#employeesTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel mr-2"></i>Export ke Excel',
                        className: 'exportExcel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf mr-2"></i>Export ke PDF',
                        className: 'exportPdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2"></i>Print',
                        className: 'exportPrint',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                initComplete: function() {
                    const api = this.api();
                    const $thead = $('#employeesTable thead');
                    const $searchRow = $('<tr class="column-search-row"></tr>');
                    $thead.find('tr:first th').each(function(i) {
                        const title = $(this).text().trim().toLowerCase();
                        if (title.includes("aksi") || title === "") {
                            $searchRow.append('<th></th>');
                        } else {
                            $searchRow.append(
                                `<th><input type="text" placeholder="Cari ${$(this).text()}" class="w-full rounded px-2 py-1 text-sm bg-white text-gray-900 border dark:bg-gray-700 dark:text-white dark:border-gray-600"></th>`
                            );
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
                    search: "Cari Global:",
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikut",
                        previous: "Sebelum"
                    },
                    zeroRecords: "Tidak ditemukan data",
                    emptyTable: "Belum ada data pekerja"
                },
                pageLength: 10,
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script>

    <style>
        .exportExcel {
            background-color: #16a34a !important;
            color: white;
            border-radius: 6px;
            margin-right: 5px;
        }

        .exportPdf {
            background-color: #dc2626 !important;
            color: white;
            border-radius: 6px;
            margin-right: 5px;
        }

        .exportPrint {
            background-color: #2563eb !important;
            color: white;
            border-radius: 6px;
        }

        .dark .dataTables_wrapper {
            background-color: #1f2937;
            color: #e5e7eb;
        }

        .dark table.dataTable thead th {
            background-color: #111827 !important;
            color: #f3f4f6;
        }

        .column-search-row input {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
        }

        .dark .column-search-row input {
            background-color: #374151;
            border-color: #4b5563;
            color: white;
        }
    </style>
</x-app-layout>
