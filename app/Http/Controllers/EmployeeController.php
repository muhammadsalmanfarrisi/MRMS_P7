<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // 1. LIHAT SEMUA DATA (INDEX)
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employees.index', compact('employees'));
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
