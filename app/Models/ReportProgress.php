<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportProgress extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model.
     *
     * @var string
     */
    protected $table = 'report_progress';

    /**
     * Kolom yang dapat diisi (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'employee_id',
        'description',
        'progress_percent',
        'obstacles',
        'photo_path',
        'video_path',
    ];

    /**
     * Atribut yang akan di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'progress_percent' => 'integer',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /**
     * Relasi ke Task.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Relasi ke Employee (petugas/teknisi yang melaporkan).
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Relasi ke ReportInstructionDone (instruksi yang sudah/selesai dikerjakan).
     */
    public function instructionsDone(): HasMany
    {
        return $this->hasMany(ReportInstructionDone::class);
    }
}
