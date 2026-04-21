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
        Schema::table('task_detail_instructions', function (Blueprint $table) {
            // Menambahkan kolom is_done setelah kolom order
            $table->boolean('is_done')->default(false)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_detail_instructions', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn('is_done');
        });
    }
};
