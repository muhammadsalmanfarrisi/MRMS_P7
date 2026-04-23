<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EmployeeController extends Controller
{
    // INDEX dengan statistik task
    public function index()
    {
        $employees = Employee::with('tasks')->get();

        $employees->each(function ($employee) {
            $today = Carbon::today();
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();

            $tasks = $employee->tasks; // Collection dari model Task

            $employee->tasks_today = $tasks->where('deadline', '>=', $today)->count();
            $employee->tasks_pending = $tasks->where('status', 'processed')->count();
            $employee->tasks_in_progress = $tasks->where('status', 'Worked on')->count();
            $employee->tasks_this_week = $tasks->where('status', 'finished')
                ->whereBetween('completed_at', [$startOfWeek, $endOfWeek])
                ->count();
        });

        return view('employees.index', compact('employees'));
    }

    // SHOW - menampilkan seluruh task yang dikerjakan oleh employee tertentu
    public function show(Employee $employee)
    {
        // Query dasar: semua tasks milik employee ini
        $tasksQuery = $employee->tasks();

        // Filter berdasarkan tanggal (jika ada)
        if ($date = request('date')) {
            $tasksQuery->whereDate('deadline', $date);
        }

        // Filter berdasarkan status (jika ada)
        if ($status = request('status')) {
            $tasksQuery->where('status', $status);
        }

        // Ambil hasil query yang sudah difilter
        $filteredTasks = $tasksQuery->get();

        // Load relasi tasks (jika masih diperlukan untuk keperluan lain)
        // Karena kita sudah punya $filteredTasks, kita bisa tidak load ulang
        // $employee->load('tasks'); // opsional, jika butuh data lengkap untuk bagian lain

        return view('employees.show', compact('employee', 'filteredTasks'));
    }


    // 2. HALAMAN FORM TAMBAH
    public function create()
    {
        return view('employees.create');
    }

    // 3. PROSES SIMPAN DATA BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'telegram_username' => 'nullable|string|max:50',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Data pekerja berhasil ditambahkan!');
    }

    // 4. HALAMAN FORM EDIT
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // 5. PROSES UPDATE DATA
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'telegram_username' => 'nullable|string|max:50',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Data pekerja berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pekerja berhasil dihapus!');
    }
}
