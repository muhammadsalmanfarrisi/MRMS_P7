<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_task', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel tasks
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            // Foreign key ke tabel employees
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Opsional: Hapus kolom 'assigned_to' dari tabel tasks karena sudah tidak dipakai
        // Schema::table('tasks', function (Blueprint $table) {
        //     $table->dropForeign(['assigned_to']);
        //     $table->dropColumn('assigned_to');
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_task');
    }
};
