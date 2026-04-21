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
        // 1. Mengubah Tabel Pivot employee_task
        Schema::table('employee_task', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable()->change();
            $table->foreignId('employee_id')->nullable()->change();
        });

        // 2. Mengubah Tabel task_detail_instructions
        Schema::table('task_detail_instructions', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable()->change();
            $table->text('instruction_step')->nullable()->change();
            $table->integer('order')->nullable()->change();
        });

        // 3. Mengubah Tabel task_materials
        Schema::table('task_materials', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable()->change();
            $table->string('material_name')->nullable()->change();
            $table->string('quantity')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika ingin mengembalikan ke "tidak boleh null" (NOT NULL)
        Schema::table('employee_task', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable(false)->change();
            $table->foreignId('employee_id')->nullable(false)->change();
        });
        
        // ... lakukan hal yang sama untuk tabel lainnya jika perlu ...
    }
};