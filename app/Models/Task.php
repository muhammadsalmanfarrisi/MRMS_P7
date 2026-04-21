<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'reporter_name',
    'damaged_tool',
    'report_time',
    'cause',
    'description',
    'photo_url',
    'video_url',
    'status',
    'execution_time',
    'assigned_to',
    'instructions',
    'deadline',
    'materials_needed',
    'additional_info'
])]
class Task extends Model
{
    use HasFactory;

    /**
     * Relasi ke model Employee
     * Memungkinkan pemanggilan seperti: $task->assignee->name
     */
    // Ganti fungsi assignee() sebelumnya dengan ini:
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
    // Tambahkan di dalam class Task
    public function detail_instructions()
    {
        return $this->hasMany(TaskDetailInstruction::class)->orderBy('order', 'asc');
    }
    public function materials()
    {
        return $this->hasMany(TaskMaterial::class);
    }


    // Relasi ke material yang dibutuhkan (jika many-to-many)

}
