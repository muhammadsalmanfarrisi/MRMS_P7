<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['task_id', 'instruction_step', 'order', 'created_at', 'updated_at', 'is_done'])]
class TaskDetailInstruction extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
