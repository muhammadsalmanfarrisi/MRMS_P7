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
        // Hanya broadcast jika status awal adalah 'unprocessed'
        if ($task->status === 'unprocessed') {
            event(new TaskActivity($task, 'created'));
        }
    }

    /**
     * Handle the Task "updated" event.
     * Triggered saat task diupdate (perubahan status).
     */
    public function updated(Task $task): void
    {
        // Cek apakah kolom 'status' berubah
        if ($task->isDirty('status')) {
            $newStatus = $task->status;

            // Status yang diizinkan untuk di-broadcast
            $allowedStatuses = ['processed', 'worked_on', 'finished'];

            if (in_array($newStatus, $allowedStatuses)) {
                event(new TaskActivity($task, 'updated', $newStatus));
            }
        }
    }
}
