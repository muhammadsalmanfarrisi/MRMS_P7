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
        Schema::table('work_reports', function (Blueprint $table) {
            // Menyimpan path foto (nullable karena mungkin tidak selalu ada)
            $table->string('photo')->nullable()->after('damage_cause_analysis');
            // Menyimpan path video (nullable)
            $table->string('video')->nullable()->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_reports', function (Blueprint $table) {
            $table->dropColumn(['photo', 'video']);
        });
    }
};
