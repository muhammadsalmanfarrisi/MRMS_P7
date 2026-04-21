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
        Schema::create('task_detail_instructions', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel tasks
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();

            // Isi instruksi detail
            $table->text('instruction_step');
            $table->integer('order')->default(0); // Untuk mengurutkan langkah 1, 2, 3...

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_detail_instructions');
    }
};
