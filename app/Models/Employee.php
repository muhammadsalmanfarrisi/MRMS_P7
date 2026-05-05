<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'skill', 'phone_number', 'telegram_username'])]
class Employee extends Model
{
    use HasFactory;
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    public function reportProgresses()
    {
        return $this->hasMany(ReportProgress::class);
    }
}
