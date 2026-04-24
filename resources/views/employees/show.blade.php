{{-- resources/views/employees/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 opacity-90"></div>
            <div class="relative px-6 py-6 md:px-8 md:py-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-white/20 backdrop-blur rounded-xl">
                            <i class="bi bi-person-badge text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-white">Detail Tugas Pekerja</h2>
                            <p class="text-white/80 text-sm">{{ $employee->name }} · {{ $employee->skill }}</p>
                        </div>
                    </div>
                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 bg-white/20 backdrop-blur rounded-xl text-white hover:bg-white/30 transition">
                        <i class="bi bi-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        {{-- Detail Lengkap Karyawan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="bi bi-person-vcard text-indigo-500 text-xl"></i> Informasi Pekerja
                </h3>
                <dl class="space-y-3">
                    <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                        <dt class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium"><i
                                class="bi bi-person mr-1"></i> Nama</dt>
                        <dd class="flex-1 text-gray-900 dark:text-white font-medium">{{ $employee->name }}</dd>
                    </div>
                    <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                        <dt class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium"><i
                                class="bi bi-tools mr-1"></i> Skill</dt>
                        <dd class="flex-1 text-gray-900 dark:text-white font-medium">{{ $employee->skill }}</dd>
                    </div>
                    <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                        <dt class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium"><i
                                class="bi bi-telephone mr-1"></i> Telepon</dt>
                        <dd class="flex-1 text-gray-900 dark:text-white">
                            {{ $employee->phone_number ?? '—' }}
                        </dd>
                    </div>
                    <div class="flex items-center">
                        <dt class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium"><i
                                class="bi bi-telegram mr-1"></i> Telegram</dt>
                        <dd class="flex-1 text-gray-900 dark:text-white">
                            {{ $employee->telegram_username ? '@' . $employee->telegram_username : '—' }}
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Statistik Tugas --}}
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="bi bi-bar-chart-steps text-indigo-500 text-xl"></i> Ringkasan Tugas
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $today = \Carbon\Carbon::today();
                        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
                        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();

                        $tasks = $employee->tasks;

                        $totalTasks = $tasks->count();
                        $tasksToday = $tasks
                            ->filter(function ($task) use ($today) {
                                return $task->deadline && \Carbon\Carbon::parse($task->deadline)->gte($today);
                            })
                            ->count();
                        $tasksPending = $tasks->where('status', 'processed')->count();
                        $tasksInProgress = $tasks->where('status', 'worked_on')->count();
                        $tasksCompletedThisWeek = $tasks
                            ->filter(function ($task) use ($startOfWeek, $endOfWeek) {
                                return $task->status === 'finished' &&
                                    $task->completed_at &&
                                    \Carbon\Carbon::parse($task->completed_at)->between($startOfWeek, $endOfWeek);
                            })
                            ->count();

                        $tasksCompletedToday = $tasks
                            ->filter(function ($task) use ($today) {
                                return $task->status === 'finished' &&
                                    $task->completed_at &&
                                    \Carbon\Carbon::parse($task->completed_at)->isSameDay($today);
                            })
                            ->count();
                    @endphp

                    <!-- Card Total Tugas -->
                    <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-xl p-4">
                        <div class="text-sm text-indigo-600 dark:text-indigo-300 font-medium">Total Tugas</div>
                        <div class="text-3xl font-bold text-indigo-700 dark:text-indigo-200 mt-1">{{ $totalTasks }}
                        </div>
                    </div>

                    <!-- Card Deadline Hari Ini -->
                    <div class="bg-amber-50 dark:bg-amber-900/30 rounded-xl p-4">
                        <div class="text-sm text-amber-600 dark:text-amber-300 font-medium">Pekerjaan Deadline Hari Ini
                        </div>
                        <div class="text-3xl font-bold text-amber-700 dark:text-amber-200 mt-1">{{ $tasksToday }}
                        </div>
                    </div>

                    <!-- Card Belum Dikerjakan -->
                    <div class="bg-red-50 dark:bg-red-900/30 rounded-xl p-4">
                        <div class="text-sm text-red-600 dark:text-red-300 font-medium">Belum Dikerjakan</div>
                        <div class="text-3xl font-bold text-red-700 dark:text-red-200 mt-1">{{ $tasksPending }}</div>
                    </div>

                    <!-- Card Proses Pengerjaan -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 rounded-xl p-4">
                        <div class="text-sm text-yellow-600 dark:text-yellow-300 font-medium">Proses Pengerjaan</div>
                        <div class="text-3xl font-bold text-yellow-700 dark:text-yellow-200 mt-1">
                            {{ $tasksInProgress }}</div>
                    </div>

                    <!-- Card Selesai Minggu Ini -->
                    <div class="bg-green-50 dark:bg-green-900/30 rounded-xl p-4 col-span-2">
                        <div class="text-sm text-green-600 dark:text-green-300 font-medium">Selesai Minggu Ini</div>
                        <div class="text-3xl font-bold text-green-700 dark:text-green-200 mt-1">
                            {{ $tasksCompletedThisWeek }}</div>
                    </div>
                </div>

                <!-- Baris baru untuk Selesai Hari Ini -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="bg-emerald-50 dark:bg-emerald-900/30 rounded-xl p-4 col-span-2">
                        <div class="text-sm text-emerald-600 dark:text-emerald-300 font-medium">✅ Selesai Hari Ini</div>
                        <div class="text-3xl font-bold text-emerald-700 dark:text-emerald-200 mt-1">
                            {{ $tasksCompletedToday }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Semua Tugas --}}
        {{-- Card Premium Daftar Tugas Karyawan --}}
        {{-- Card Premium Daftar Tugas Karyawan --}}
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

                {{-- Toolbar Premium --}}
                <div
                    class="relative p-4 border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-between items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-indigo-500 dark:text-indigo-400 text-lg"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tugas
                            {{ $employee->name }}</span>
                        <span
                            class="text-xs bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-full">{{ $employee->tasks->count() }}
                            record</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button id="refreshEmployeeTasks"
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all"
                            title="Refresh Data">
                            <i class="bi bi-arrow-repeat text-lg"></i>
                        </button>
                    </div>
                </div>

                {{-- Filter Premium --}}
                <div class="relative p-5 md:p-6 space-y-4">
                    {{-- Filter Tanggal dengan Auto-Submit --}}
                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-white/90 via-white/80 to-indigo-50/60 dark:from-gray-800/90 dark:via-gray-800/80 dark:to-indigo-900/30 backdrop-blur-md shadow-xl border border-white/30 dark:border-gray-700/50 transition-all duration-500 group">
                        <div
                            class="absolute -top-10 -right-10 w-40 h-40 bg-blue-400/20 dark:bg-blue-600/20 rounded-full blur-3xl">
                        </div>
                        <div
                            class="absolute -bottom-10 -left-10 w-40 h-40 bg-cyan-400/20 dark:bg-cyan-600/20 rounded-full blur-3xl">
                        </div>

                        <div class="relative p-5 md:p-6">
                            <form method="GET" action="{{ route('employees.show', $employee->id) }}" id="filterForm"
                                class="space-y-4">
                                {{-- Input Tanggal --}}
                                <div>
                                    <label for="date"
                                        class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <span
                                            class="p-1.5 bg-blue-100 dark:bg-blue-900/40 rounded-lg text-blue-600 dark:text-blue-400">
                                            <i class="far fa-calendar-alt text-sm"></i>
                                        </span>
                                        <span>Filter Deadline Tugas</span>
                                    </label>
                                    <div class="relative group/date">
                                        <div
                                            class="absolute -inset-0.5 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-xl opacity-0 group-hover/date:opacity-100 blur transition duration-500">
                                        </div>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                                <i
                                                    class="far fa-calendar-alt text-lg text-transparent bg-clip-text bg-gradient-to-br from-indigo-500 to-blue-600 dark:from-indigo-400 dark:to-blue-400"></i>
                                            </div>
                                            <input type="text" name="date" id="datepicker"
                                                onchange="document.getElementById('filterForm').submit();"
                                                class="w-full pl-12 pr-12 py-3.5 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm border-2 border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-white text-sm font-medium shadow-[0_8px_20px_-6px_rgba(0,0,0,0.1)] dark:shadow-[0_8px_20px_-6px_rgba(0,0,0,0.4)] focus:outline-none focus:border-transparent focus:ring-4 focus:ring-indigo-400/30 dark:focus:ring-indigo-600/30 hover:border-indigo-300 dark:hover:border-indigo-700 transition-all duration-300 cursor-pointer appearance-none"
                                                value="{{ request('date', now()->toDateString()) }}">
                                            <div
                                                class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                                                <i
                                                    class="fas fa-chevron-down text-xs text-indigo-500 dark:text-indigo-400 opacity-70 group-hover/date:opacity-100 transition"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <i class="far fa-info-circle"></i>
                                        Klik ikon kalender untuk pilih tanggal, data akan langsung diperbarui otomatis.
                                    </p>
                                </div>

                                {{-- Filter Status dengan Tombol Terapkan --}}
                                <div>
                                    <label
                                        class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <span
                                            class="p-1.5 bg-purple-100 dark:bg-purple-900/40 rounded-lg text-purple-600 dark:text-purple-400">
                                            <i class="bi bi-funnel-fill text-sm"></i>
                                        </span>
                                        <span>Filter Status</span>
                                    </label>
                                    <div class="flex gap-2">
                                        <select name="status" id="status"
                                            class="appearance-none w-full pl-4 pr-10 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl text-gray-800 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all duration-200">
                                            <option value="">📋 Semua Status</option>
                                            <option value="processed"
                                                {{ request('status') == 'processed' ? 'selected' : '' }}>⏳ Sedang di
                                                Proses</option>
                                            <option value="worked_on"
                                                {{ request('status') == 'worked_on' ? 'selected' : '' }}>🛠️ Sedang
                                                Dikerjakan</option>
                                            <option value="finished"
                                                {{ request('status') == 'finished' ? 'selected' : '' }}>✅ Selesai
                                                Dikerjakan</option>
                                            <option value="Completed"
                                                {{ request('status') == 'Completed' ? 'selected' : '' }}>🎉 Completed
                                            </option>
                                            <option value="In Progress"
                                                {{ request('status') == 'In Progress' ? 'selected' : '' }}>⚡ In
                                                Progress</option>
                                        </select>
                                        <button type="submit"
                                            class="px-5 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-md transition flex items-center gap-2">
                                            <i class="bi bi-funnel-fill"></i> Terapkan
                                        </button>
                                    </div>
                                    @if (request('status'))
                                        <div class="text-right mt-1">
                                            <a href="{{ route('employees.show', ['employee' => $employee->id, 'date' => request('date')]) }}"
                                                class="text-xs text-purple-600 hover:underline">Hapus filter status</a>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            {{-- Chip Filter Aktif --}}
                            @if (request('status') || request('date'))
                                <div
                                    class="flex flex-wrap gap-2 mt-4 text-xs bg-gray-100 dark:bg-gray-800 rounded-lg p-3">
                                    @if (request('status'))
                                        <span
                                            class="bg-purple-100 dark:bg-purple-900/40 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full flex items-center gap-1">
                                            Status: {{ ucfirst(str_replace('_', ' ', request('status'))) }}
                                            <a href="{{ route('employees.show', ['employee' => $employee->id, 'date' => request('date')]) }}"
                                                class="hover:text-purple-600">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </a>
                                        </span>
                                    @endif
                                    @if (request('date'))
                                        <span
                                            class="bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full flex items-center gap-1">
                                            Deadline:
                                            {{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d F Y') }}
                                            <a href="{{ route('employees.show', ['employee' => $employee->id, 'status' => request('status')]) }}"
                                                class="hover:text-blue-600">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tabel dengan DataTables --}}
                <div class="overflow-x-auto relative p-4">
                    @if ($filteredTasks->count() > 0)
                        <table id="employeeTasksTable" class="min-w-full text-gray-700 dark:text-gray-300">
                            <thead class="bg-gray-50/80 dark:bg-gray-900/50 backdrop-blur-sm">
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-4 px-4 text-left font-semibold text-sm">Alat/Mesin</th>
                                    <th class="py-4 px-4 text-left font-semibold text-sm">Status</th>
                                    <th class="py-4 px-4 text-left font-semibold text-sm">Deadline</th>
                                    <th class="py-4 px-4 text-center font-semibold text-sm">Laporan</th>
                                    <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredTasks as $task)
                                    <tr
                                        class="border-b border-gray-100 dark:border-gray-800 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-all duration-200 group">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                                    <i class="bi bi-wrench text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-gray-900 dark:text-white">
                                                        {{ $task->damaged_tool ?? 'Tidak disebutkan' }}</div>
                                                    <div class="text-xs text-gray-500">Deadline:
                                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                                    </div>
                                                </div>
                                            </div>
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
                                                <i class="bi bi-circle-fill mr-1 text-[6px]"></i>
                                                {{ $status['label'] }}
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
                                            @php
                                                $latestReport = $task
                                                    ->workReports()
                                                    ->whereNotNull('completed_at')
                                                    ->latest('completed_at')
                                                    ->first();
                                            @endphp
                                            @if ($latestReport && ($latestReport->photo || $latestReport->video))
                                                <div class="flex items-center justify-center gap-2">
                                                    @if ($latestReport->photo)
                                                        <a href="{{ asset('storage/' . $latestReport->photo) }}"
                                                            target="_blank" class="group relative">
                                                            <img src="{{ asset('storage/' . $latestReport->photo) }}"
                                                                alt="Foto Pekerjaan"
                                                                class="w-10 h-10 object-cover rounded-lg shadow-md hover:scale-150 transition-transform duration-300 z-10 hover:z-50">
                                                            <span
                                                                class="absolute -top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Foto</span>
                                                        </a>
                                                    @endif
                                                    @if ($latestReport->video)
                                                        <a href="{{ asset('storage/' . $latestReport->video) }}"
                                                            target="_blank" class="group relative">
                                                            <div
                                                                class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center shadow-md hover:scale-150 transition-transform duration-300">
                                                                <i class="bi bi-play-fill text-white text-xl"></i>
                                                            </div>
                                                            <span
                                                                class="absolute -top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Video</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs italic">—</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('tasks.show', $task->id) }}"
                                                    class="p-2 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 hover:bg-indigo-200 dark:hover:bg-indigo-800/50 transition-all duration-200"
                                                    title="Lihat Detail Pekerjaan">
                                                    <i class="bi bi-eye-fill text-sm"></i>
                                                </a>
                                                <a href="{{ route('tasks.edit', $task->id) }}"
                                                    class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 dark:hover:bg-amber-800/50 transition-all duration-200"
                                                    title="Edit Pekerjaan">
                                                    <i class="bi bi-pencil-square text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            <i class="bi bi-inbox text-5xl"></i>
                            <p class="mt-2">Tidak ada tugas yang sesuai dengan filter.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @push('scripts')
            {{-- Flatpickr untuk Datepicker --}}
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

            {{-- DataTables --}}
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

            <script>
                $(document).ready(function() {
                    // Inisialisasi Flatpickr
                    flatpickr("#datepicker", {
                        dateFormat: "Y-m-d",
                        defaultDate: "{{ request('date', now()->toDateString()) }}",
                        locale: "id",
                        theme: "material_blue",
                        onChange: function(selectedDates, dateStr, instance) {
                            document.getElementById('filterForm').submit();
                        }
                    });

                    // Inisialisasi DataTables
                    const table = $('#employeeTasksTable').DataTable({
                        responsive: true,
                        dom: "<'flex flex-col md:flex-row justify-between items-center mb-4 gap-3'<'flex gap-2'f>>" +
                            "<'overflow-x-auto't>" +
                            "<'flex flex-col md:flex-row justify-between items-center mt-4 gap-3'<'text-sm'i><'pagination-wrapper'p>>",
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
                            $('.dataTables_filter input').attr('placeholder', 'Cari alat, status...')
                                .addClass(
                                    'rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2'
                                );
                            $('.dataTables_length select').addClass(
                                'rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2'
                            );
                        }
                    });

                    $('#refreshEmployeeTasks').on('click', function() {
                        location.reload();
                    });
                });
            </script>
        @endpush
    </div>
</x-app-layout>
