<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class WorkReport extends Model
{
    /**
     * Kolom yang boleh diisi massal (mass assignment).
     */
    protected $fillable = [
        'task_id',
        'employe_id',
        'initial_condition',
        'repair_done',
        'damage_cause_analysis',
        'photo',
        'video',
        'completed_at',
    ];

    /**
     * Casting tipe data atribut.
     */
    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * Relasi ke model Task.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Relasi ke model Employee (pekerja yang membuat laporan).
     * Foreign key: employe_id, references: id pada tabel employees.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employe_id');
    }

    /**
     * Accessor: Mendapatkan URL lengkap foto (jika ada).
     * Cocok digunakan jika file disimpan di storage Laravel (local/public/s3).
     * Contoh pemanggilan: $report->photo_url
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    /**
     * Accessor: Mendapatkan URL lengkap video (jika ada).
     */
    public function getVideoUrlAttribute(): ?string
    {
        return $this->video ? Storage::url($this->video) : null;
    }
}
