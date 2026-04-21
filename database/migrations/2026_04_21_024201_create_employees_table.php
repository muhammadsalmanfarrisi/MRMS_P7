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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' otomatis
            $table->string('name'); // Nama pekerja
            $table->string('skill'); // Keahlian

            // Karena bisa telepon atau telegram, kita buat dua kolom terpisah 
            // dan jadikan nullable (boleh kosong salah satunya)
            $table->string('phone_number')->nullable();
            $table->string('telegram_username')->nullable();

            $table->timestamps(); // Otomatis membuat 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
