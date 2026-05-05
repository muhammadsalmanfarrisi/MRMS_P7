<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportInstructionDone extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model.
     *
     * @var string
     */
    protected $table = 'report_instructions_done';

    /**
     * Kolom yang dapat diisi (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_progress_id',
        'instruction_id',
        'step',
        'is_done',
    ];

    /**
     * Atribut yang akan di-cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_done' => 'boolean',
    ];

    /**
     * Relasi ke ReportProgress.
     */
    public function reportProgress(): BelongsTo
    {
        return $this->belongsTo(ReportProgress::class);
    }
}
