<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskActivity implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $action;       // 'created' atau 'updated'
    public $newStatus;    // status terbaru (jika updated)

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task, string $action, ?string $newStatus = null)
    {
        $this->task = $task;
        $this->action = $action;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('tasks');
    }

    /**
     * Nama event yang akan didengar di frontend.
     */
    public function broadcastAs(): string
    {
        return 'task.activity';
    }

    /**
     * Data yang dikirim ke frontend.
     */
    public function broadcastWith(): array
    {
        return [
            'id'            => $this->task->id,
            'reporter_name' => $this->task->reporter_name,
            'damaged_tool'  => $this->task->damaged_tool,
            'status'        => $this->task->status,
            'action'        => $this->action,
            'new_status'    => $this->newStatus,
            'time'          => now()->toDateTimeString(),
        ];
    }
}