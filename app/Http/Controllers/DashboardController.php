<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\ReportProgress;

class DashboardController extends Controller
{
    public function index(): View
    {
        try {
            $now = Carbon::now('Asia/Jakarta');
            // Statistik utama
            $totalTasks = Task::whereDate('deadline', Carbon::now('Asia/Jakarta')->toDateString())->count();
            $totalEmployees = Employee::count();
            $approachingDeadline = Task::whereDate('deadline', '<=', Carbon::now()->addDays(3))
                ->where('status', '!=', 'finished')
                ->count();

            // ✅ BARU: Tugas yang deadline-nya sudah lewat dan belum selesai
            $overdueTasks = Task::where('deadline', '<', $now)
                ->where('status', '!=', 'finished')
                ->count();

            // Status progres pekerjaan (untuk baris kedua)
            $unprocessedTasks = Task::where('status', 'unprocessed')->count();
            $inProgressTasks  = Task::where('status', 'processed')->count();
            $workedOnTasks    = Task::where('status', 'worked_on')->count();
            $completedTasks   = Task::where('status', 'finished')->count();

            $recentTasks = Task::with('employees')->latest()->take(5)->get();
            $totalProgressReports = ReportProgress::count();
        } catch (\Exception $e) {
            $totalTasks = 0;
            $totalEmployees = 0;
            $approachingDeadline = 0;
            $unprocessedTasks = 0;
            $inProgressTasks = 0;
            $workedOnTasks = 0;
            $completedTasks = 0;
            $recentTasks = collect();
            $totalProgressReports = 0;
        }



        $recentActivities = Task::whereIn('status', ['unprocessed', 'processed', 'worked_on', 'finished'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($task) {
                // Cek apakah created_at dan updated_at valid
                $created = $task->created_at;
                $updated = $task->updated_at;

                // Tentukan action
                if ($created && $updated && $created->eq($updated)) {
                    $action = 'created';
                } else {
                    $action = 'updated';
                }

                // ❗️ Jangan tampilkan jika action updated dan status unprocessed
                if ($action === 'updated' && $task->status === 'unprocessed') {
                    return null;
                }

                return [
                    'id'            => $task->id,
                    'reporter_name' => $task->reporter_name ?? 'Unknown',
                    'damaged_tool'  => $task->damaged_tool ?? '-',
                    'status'        => $task->status,
                    'action'        => $action,
                    'time'          => $updated ? $updated->toDateTimeString() : now()->toDateTimeString(),
                ];
            })
            ->filter()   // Buang elemen null
            ->values();  // Reset indeks array

        // Tambahkan ke compact
        return view('dashboard', compact(
            'totalTasks',
            'totalEmployees',
            'approachingDeadline',
            'overdueTasks',
            'unprocessedTasks',
            'inProgressTasks',
            'workedOnTasks',
            'completedTasks',
            'totalProgressReports',
            'recentTasks',          // jika masih diperlukan di tempat lain
            'recentActivities'      // ← data untuk notifikasi
        ));
    }
}
