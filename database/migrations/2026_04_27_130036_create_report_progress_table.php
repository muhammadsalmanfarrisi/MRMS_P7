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
        Schema::create('report_progress', function (Blueprint $table) {
            $table->id();                               // kolom id (primary key auto-increment)
            $table->foreignId('task_id')                // foreign key ke tabel tasks
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('employee_id')            // foreign key ke tabel employees
                ->constrained()
                ->cascadeOnDelete();
            $table->text('progress_information');       // informasi progress berbahasa Inggris
            $table->timestamps();                       // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_progress');
    }
};
