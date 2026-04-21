<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskMaterial extends Model
{
    // Tambahkan properti $fillable di sini
    protected $fillable = [
        'task_id',
        'material_name',
        'quantity',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
