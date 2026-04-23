<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use App\Models\TaskMaterial;
use App\Models\TaskDetailInstruction;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;  // ← Tambahkan ini

class DashboardController extends Controller
{
    public function index(): View
    {
        try {
            $totalTasks = Task::count();
            $completedTasks = Task::where('status', 'completed')->count();
            $inProgressTasks = Task::whereIn('status', ['pending', 'in_progress'])->count();
            $approachingDeadline = Task::whereDate('deadline', '<=', Carbon::now()->addDays(3))
                ->where('status', '!=', 'completed')
                ->count();
            $totalEmployees = Employee::count();

            // 🔧 Cast kolom quantity ke integer di level database
            $totalMaterialQty = TaskMaterial::sum(DB::raw('quantity::integer')) ?? 0;

            $pendingInstructions = TaskDetailInstruction::where('is_done', false)->count();
            $recentTasks = Task::with('employees')->latest()->take(5)->get();
        } catch (\Exception $e) {
            $totalTasks = 0;
            $completedTasks = 0;
            $inProgressTasks = 0;
            $approachingDeadline = 0;
            $totalEmployees = 0;
            $totalMaterialQty = 0;
            $pendingInstructions = 0;
            $recentTasks = collect();
        }

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'inProgressTasks',
            'approachingDeadline',
            'totalEmployees',
            'totalMaterialQty',
            'pendingInstructions',
            'recentTasks'
        ));
    }
}
