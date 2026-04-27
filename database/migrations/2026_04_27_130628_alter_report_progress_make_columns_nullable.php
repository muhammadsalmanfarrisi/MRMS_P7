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
        Schema::table('report_progress', function (Blueprint $table) {
            // 1. Ubah progress_information menjadi nullable (cukup sederhana)
            $table->text('progress_information')->nullable()->change();

            // 2. task_id: hapus constraint, ubah nullable, tambahkan constraint lagi
            $table->dropForeign(['task_id']);                      // hapus FK lama
            $table->unsignedBigInteger('task_id')->nullable()->change();
            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->cascadeOnDelete();

            // 3. employee_id: sama seperti di atas
            $table->dropForeign(['employee_id']);
            $table->unsignedBigInteger('employee_id')->nullable()->change();
            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_progress', function (Blueprint $table) {
            // Kembalikan menjadi NOT NULL (Ini akan gagal jika sudah ada data NULL)
            // task_id
            $table->dropForeign(['task_id']);
            $table->unsignedBigInteger('task_id')->nullable(false)->change();
            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->cascadeOnDelete();

            // employee_id
            $table->dropForeign(['employee_id']);
            $table->unsignedBigInteger('employee_id')->nullable(false)->change();
            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->cascadeOnDelete();

            // progress_information
            $table->text('progress_information')->nullable(false)->change();
        });
    }
};
