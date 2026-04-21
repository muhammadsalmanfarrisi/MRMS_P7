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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Data Laporan Kerusakan
            $table->string('reporter_name')->nullable();
            $table->string('damaged_tool')->nullable();
            $table->dateTime('report_time')->nullable();
            $table->text('cause')->nullable();
            $table->text('description')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('video_url')->nullable();

            // Status & Eksekusi
            $table->string('status')->nullable(); // Contoh: Pending, In Progress, Completed
            $table->dateTime('execution_time')->nullable();

            // Relasi ke tabel employees (Bisa diset null jika belum ada yang ditugaskan)
            $table->foreignId('assigned_to')->nullable()->constrained('employees')->nullOnDelete();

            // Detail Penugasan
            $table->text('instructions')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->text('materials_needed')->nullable();
            $table->text('additional_info')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
