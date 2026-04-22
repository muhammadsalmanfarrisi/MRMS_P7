<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Default ke hari ini jika tidak ada input
        $selectedDate = $request->query('date', Carbon::now()->toDateString());

        $tasks = Task::where('status', '!=', 'unprocessed')
            ->whereDate('deadline', $selectedDate) // langsung filter berdasarkan tanggal yang dipilih
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks', 'selectedDate'));
    }

    public function create()
    {
        $workers = Employee::all();
        return view('tasks.create', compact('workers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'damaged_tool' => 'nullable|string|max:255',
            'cause' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:20480',
            'execution_time' => 'nullable|date',
            'assigned_to' => 'nullable|exists:employees,id',
            'instructions' => 'nullable|string',
            'deadline' => 'nullable|date',
            'materials_needed' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'employee_ids' => 'nullable|array',
            'employee_ids.*' => 'exists:employees,id',
            'steps' => 'nullable|array',
            'steps.*' => 'nullable|string',
            'material_names' => 'nullable|array',
            'material_quantities' => 'nullable|array',
        ]);

        // === ISI DATA OTOMATIS DI SINI ===
        $data['reporter_name'] = Auth::user()->name; // Mengambil nama user yang sedang login
        $data['report_time'] = now(); // Mengambil waktu server saat ini
        $data['status'] = 'processed'; // Mengambil waktu server saat ini
        if ($request->hasFile('photo')) {
            $data['photo_url'] = $request->file('photo')->store('tasks/photos', 'public');
        }
        if ($request->hasFile('video')) {
            $data['video_url'] = $request->file('video')->store('tasks/videos', 'public');
        }

        $task = Task::create($data);

        // Sambungkan dengan banyak pekerja
        if ($request->filled('employee_ids')) {
            $task->employees()->attach($request->employee_ids);
        }
        // Simpan instruksi detail jika ada
        if ($request->has('steps')) {
            foreach ($request->steps as $index => $step) {
                $task->detail_instructions()->create([
                    'instruction_step' => $step,
                    'order' => $index + 1
                ]);
            }
        }
        // Simpan Material
        if ($request->has('material_names')) {
            foreach ($request->material_names as $index => $name) {
                if (!empty($name)) {
                    $task->materials()->create([
                        'material_name' => $name,
                        'quantity' => $request->material_quantities[$index] ?? '1'
                    ]);
                }
            }
        }
        return redirect()->route('tasks.index')->with('success', 'Pekerjaan baru berhasil didaftarkan.');
    }

    public function edit(Task $task)
    {
        $workers = Employee::all();
        return view('tasks.edit', compact('task', 'workers'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'damaged_tool' => 'nullable|string|max:255',
            'cause' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:20480',
            'execution_time' => 'nullable|date',
            'assigned_to' => 'nullable|exists:employees,id',
            'instructions' => 'nullable|string',
            'deadline' => 'nullable|date',
            'materials_needed' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'employee_ids' => 'nullable|array',
            'employee_ids.*' => 'exists:employees,id',
            'steps' => 'nullable|array',
            'steps.*' => 'nullable|string',
            'material_names' => 'nullable|array',
            'material_quantities' => 'nullable|array',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($task->photo_url) Storage::disk('public')->delete($task->photo_url);
            $data['photo_url'] = $request->file('photo')->store('tasks/photos', 'public');
        }
        if ($request->hasFile('video')) {
            if ($task->video_url) Storage::disk('public')->delete($task->video_url);
            $data['video_url'] = $request->file('video')->store('tasks/videos', 'public');
        }

        $task->update($data);

        // Sync pekerja (otomatis menambah yang baru, menghapus yang tidak dicentang)
        if ($request->has('employee_ids')) {
            $task->employees()->sync($request->employee_ids);
        } else {
            $task->employees()->detach(); // Kosongkan jika tidak ada yang dipilih
        }

        // 2. Update Detailed Instructions (One-to-Many)
        // Hapus instruksi lama, lalu masukkan yang baru dari form
        $task->detail_instructions()->delete();
        if ($request->has('steps')) {
            foreach ($request->steps as $index => $step) {
                if (!empty($step)) {
                    $task->detail_instructions()->create([
                        'instruction_step' => $step,
                        'order' => $index + 1
                    ]);
                }
            }
        }

        // 3. Update Materials (One-to-Many)
        // Hapus material lama, lalu masukkan yang baru dari form
        $task->materials()->delete();
        if ($request->has('material_names')) {
            foreach ($request->material_names as $index => $name) {
                if (!empty($name)) {
                    $task->materials()->create([
                        'material_name' => $name,
                        'quantity' => $request->material_quantities[$index] ?? '1'
                    ]);
                }
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Data pekerjaan berhasil diperbarui.');
    }
    public function show($id)
    {
        $task = Task::with(['employees', 'detail_instructions', 'materials'])->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        if ($task->photo_url) Storage::disk('public')->delete($task->photo_url);
        if ($task->video_url) Storage::disk('public')->delete($task->video_url);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Data pekerjaan berhasil dihapus.');
    }
}
