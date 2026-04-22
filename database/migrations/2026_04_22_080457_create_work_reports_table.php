<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_reports', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel tasks
            $table->foreignId('task_id')
                ->constrained('tasks')
                ->onDelete('cascade');

            // Relasi ke tabel users (pekerja yang membuat laporan)
            $table->foreignId('employe_id')
                ->constrained('employees') // Asumsi pekerja adalah employee
                ->onDelete('cascade');

            // Kondisi awal (wajib)
            $table->text('initial_condition');

            // Perbaikan yang dilakukan (wajib)
            $table->text('repair_done');

            // Analisa penyebab kerusakan (opsional)
            $table->text('damage_cause_analysis')->nullable();


            // Waktu laporan diselesaikan (terisi otomatis saat tombol selesai diklik)
            $table->timestamp('completed_at')->nullable();

            // Timestamps standar Laravel (created_at, updated_at)
            $table->timestamps();

            // Index untuk performa
            $table->index('task_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_reports');
    }
};
