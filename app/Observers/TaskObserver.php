<?php

namespace App\Observers;

use App\Events\TaskActivity;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     * Triggered saat task baru dibuat (laporan masuk).
     */
    public function created(Task $task): void
    {
        \Illuminate\Support\Facades\Log::info('👁️ TaskObserver::created dipanggil', ['task_id' => $task->id]);

        if ($task->status === 'unprocessed') {
            event(new TaskActivity($task, 'created'));
        }
    }

    public function updated(Task $task): void
    {
        \Illuminate\Support\Facades\Log::info('👁️ TaskObserver::updated dipanggil', ['task_id' => $task->id]);

        if ($task->isDirty('status')) {
            $newStatus = $task->status;
            $allowedStatuses = ['processed', 'worked_on', 'finished'];

            if (in_array($newStatus, $allowedStatuses)) {
                event(new TaskActivity($task, 'updated', $newStatus));
            }
        }
    }
}
