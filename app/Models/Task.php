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
    'additional_info',
    'completed_at',
])]
class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_info' => 'array', // opsional, memudahkan akses
    ];

    // Di dalam class Task

    // Accessor untuk mendapatkan telegram_user_id dari additional_info (JSON)
    public function getTelegramUserIdAttribute()
    {
        $additional = is_string($this->additional_info)
            ? json_decode($this->additional_info, true)
            : $this->additional_info;
        return $additional['telegram_user_id'] ?? null;
    }

    // Mutator untuk menyimpan telegram_user_id ke additional_info
    public function setTelegramUserIdAttribute($value)
    {
        $additional = json_decode($this->additional_info, true) ?: [];
        $additional['telegram_user_id'] = $value;
        $this->attributes['additional_info'] = json_encode($additional);
    }

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
    public function workReports()
    {
        return $this->hasMany(WorkReport::class, 'task_id');
    }

    // Relasi ke material yang dibutuhkan (jika many-to-many)

}
