<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

        if ($task->status == 'processed') {
            $this->sendTaskAssignmentNotification($task);
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

        $oldStatus = $task->status;
        $newStatus = $request->status;

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

        // Kirim notifikasi jika status berubah
        if ($oldStatus != $newStatus) {
            $this->sendTelegramNotification($task);
        }

        if ($oldStatus != $newStatus && $newStatus == 'processed') {
            $this->sendTaskAssignmentNotification($task);
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
    public function updateStatus(Request $request, Task $task)
    {
        $oldStatus = $task->status;
        $newStatus = $request->status;

        $allowed = ['processed', 'worked_on', 'finished'];
        if (!in_array($newStatus, $allowed)) {
            return back()->with('error', 'Status tidak valid');
        }

        $task->status = $newStatus;
        $task->save();

        // Kirim notifikasi jika status berubah
        if ($oldStatus != $newStatus) {
            $this->sendTelegramNotification($task);
        }

        return back()->with('success', 'Status berhasil diupdate');
    }

    private function sendTelegramNotification(Task $task)
    {
        $chatId = $task->telegram_user_id;
        if (empty($chatId)) {
            // Bisa gunakan Log::info atau debug saja, karena ini kondisi normal jika user tidak punya Telegram
            Log::info("Telegram notification skipped: No chat ID for task {$task->id}");
            return;
        }

        $botToken = env('TELEGRAM_BOT_TOKEN');
        Log::info('sendTelegramNotification called', ['token' => $botToken ? 'ada' : 'tidak ada']);
        if (!$botToken) {
            Log::error('Bot token missing');
            return;
        }

        $chatId = $task->telegram_user_id;
        Log::info('Chat ID', ['chat_id' => $chatId]); // menggunakan accessor
        if (!$chatId) {
            Log::error('Chat ID not found for task ' . $task->id);
            return;
        }

        $statusMessages = [
            'processed' => 'sedang diproses oleh admin',
            'worked_on' => 'sedang dikerjakan oleh teknisi',
            'finished'  => 'telah selesai',
        ];



        $statusText = $statusMessages[$task->status] ?? $task->status;
        $message = "🔔 *Update Laporan Kerusakan*\n\n";
        $message .= "Alat Yang Rusak: {$task->damaged_tool}\n";
        $message .= "Waktu Pelaporan: {$task->report_time}\n";
        $message .= "Status: *{$statusText}*\n";
        $message .= "Waktu update: " . now('Asia/Jakarta')->format('d/m/Y H:i:s') . "\n\n";
        if ($task->employees->count() > 0) {
            $message .= "\n*Akan dikerjakan oleh:*\n";
            foreach ($task->employees as $emp) {
                $message .= "- {$emp->name}\n";
            }
        } else {
            $message .= "\n*Dikerjakan oleh:* Belum ditugaskan\n";
        }
        $message .= "Terima kasih.";

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);

        Log::info('Telegram response', ['status' => $response->status(), 'body' => $response->body()]);
    }

    private function sendTaskAssignmentNotification(Task $task)
    {
        $botToken = env('WORKER_BOT_TOKEN');
        if (!$botToken) {
            Log::error('WORKER_BOT_TOKEN not set');
            return;
        }

        $employees = $task->employees;
        if ($employees->isEmpty()) {
            Log::info('No employees assigned to task ' . $task->id);
            return;
        }

        // Pesan yang akan dikirim
        $message = "🔧 *TUGAS BARU DITERIMA* 🔧\n\n";
        $message .= "👥 *Ditugaskan Kepada:*\n";
        if ($task->employees->count() > 0) {
            foreach ($task->employees as $emp) {
                $message .= "   • {$emp->name}\n";
            }
        } else {
            $message .= "   • Belum Ditugaskan\n";
        }
        $message .= "📌 *Alat/Mesin:* {$task->damaged_tool}\n";
        $message .= "📝 *Deskripsi:* {$task->description}\n";
        if ($task->cause) {
            $message .= "⚠️ *Penyebab:* {$task->cause}\n";
        }
        if ($task->deadline) {
            $message .= "⏰ *Deadline:* " . \Carbon\Carbon::parse($task->deadline)->format('d/m/Y H:i') . "\n";
        }
        if ($task->instructions) {
            $message .= "📋 *Instruksi:* {$task->instructions}\n";
        }
        if ($task->detail_instructions && $task->detail_instructions->count() > 0) {
            $message .= "\n📋 *Hal yang Perlu Dikerjakan:*\n";
            foreach ($task->detail_instructions as $index => $step) {

                $stepNumber = $index + 1;
                $message .= "{$stepNumber}. {$step->instruction_step}\n";
            }
        }

        // ========== MATERIAL DIBUTUHKAN ==========
        if ($task->materials && $task->materials->count() > 0) {
            $message .= "\n📦 *Material Dibutuhkan:*\n";
            foreach ($task->materials as $material) {
                $quantity = $material->pivot->quantity ?? ($material->quantity ?? '-');
                $message .= "   • {$material->material_name}: {$quantity}\n";
            }
        }
        if ($task->materials_needed) {
            $message .= "🛠️ *Material:* {$task->materials_needed}\n";
        }
        $message .= "\nSilakan segera ditindaklanjuti.";

        // 🔹 TOMBOL INLINE
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '🔨 Lakukan Pengerjaan', 'callback_data' => "start_work_{$task->id}"]
                ]
            ]
        ];

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $successCount = 0;

        foreach ($employees as $employee) {
            $chatId = $employee->telegram_chat_id;
            if (!$chatId) {
                Log::warning("Employee {$employee->id} tidak punya telegram_chat_id");
                continue;
            }

            // 🔹 KIRIM PESAN DENGAN TOMBOL
            $response = \Illuminate\Support\Facades\Http::post($url, [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
                'reply_markup' => json_encode($keyboard) // ← HARUS json_encode
            ]);

            if ($response->successful()) {
                $successCount++;
                Log::info("Notifikasi terkirim ke employee {$employee->id}");
            } else {
                Log::error("Gagal kirim ke {$chatId}: " . $response->body());
            }
        }
        Log::info("Notifikasi tugas dikirim ke {$successCount} dari {$employees->count()} employee");
    }
}
