<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ========== 1. Tambahkan kolom baru di tabel report_progress (semua nullable) ==========
        Schema::table('report_progress', function (Blueprint $table) {
            $table->text('description')->nullable()->after('progress_information');
            $table->integer('progress_percent')->nullable()->after('description');
            $table->text('obstacles')->nullable()->after('progress_percent');
            $table->string('photo_path')->nullable()->after('obstacles');
            $table->string('video_path')->nullable()->after('photo_path');
        });

        // ========== 2. Pindahkan data dari kolom JSON ke kolom baru, kumpulkan instructions ==========
        $instructionsToInsert = [];
        $reports = DB::table('report_progress')->get(['id', 'progress_information']);

        foreach ($reports as $report) {
            if (empty($report->progress_information)) {
                continue;
            }
            $data = json_decode($report->progress_information, true);
            if (!is_array($data)) {
                continue;
            }

            // Update kolom utama (nilai null jika tidak ada di JSON)
            DB::table('report_progress')
                ->where('id', $report->id)
                ->update([
                    'description'      => $data['description'] ?? null,
                    'progress_percent' => $data['progress_percent'] ?? null,
                    'obstacles'        => $data['obstacles'] ?? null,
                    'photo_path'       => $data['photo_path'] ?? null,
                    'video_path'       => $data['video_path'] ?? null,
                ]);

            // Siapkan data instructions_done (semua kolom data nullable)
            if (isset($data['instructions_done']) && is_array($data['instructions_done'])) {
                foreach ($data['instructions_done'] as $inst) {
                    $instructionsToInsert[] = [
                        'report_progress_id' => $report->id,
                        'instruction_id'     => $inst['id'] ?? null,      // nullable
                        'step'               => $inst['step'] ?? null,    // nullable
                        'is_done'            => $inst['is_done'] ?? false,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }
            }
        }

        // ========== 3. Buat tabel report_instructions_done dengan kolom nullable ==========
        Schema::create('report_instructions_done', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_progress_id');
            $table->integer('instruction_id')->nullable();   // nullable
            $table->text('step')->nullable();                // nullable
            $table->boolean('is_done')->default(false);
            $table->timestamps();

            $table->foreign('report_progress_id')
                ->references('id')
                ->on('report_progress')
                ->onDelete('cascade');
        });

        // Insert data instructions (jika ada)
        if (!empty($instructionsToInsert)) {
            DB::table('report_instructions_done')->insert($instructionsToInsert);
        }

        // ========== 4. Hapus kolom JSON lama ==========
        Schema::table('report_progress', function (Blueprint $table) {
            $table->dropColumn('progress_information');
        });
    }

    public function down()
    {
        // Rollback: tambah kembali kolom JSON, isi dari kolom terpisah dan relasi instructions
        Schema::table('report_progress', function (Blueprint $table) {
            $table->json('progress_information')->nullable();
        });

        // Ambil data dari kolom baru dan dari tabel instructions
        $reports = DB::table('report_progress')->get([
            'id',
            'description',
            'progress_percent',
            'obstacles',
            'photo_path',
            'video_path'
        ]);

        foreach ($reports as $report) {
            $instructions = DB::table('report_instructions_done')
                ->where('report_progress_id', $report->id)
                ->get(['instruction_id', 'step', 'is_done'])
                ->map(function ($item) {
                    return [
                        'id'       => $item->instruction_id,
                        'step'     => $item->step,
                        'is_done'  => (bool) $item->is_done,
                    ];
                })->toArray();

            $jsonData = [];
            if (!is_null($report->description))      $jsonData['description'] = $report->description;
            if (!is_null($report->progress_percent)) $jsonData['progress_percent'] = $report->progress_percent;
            if (!is_null($report->obstacles))        $jsonData['obstacles'] = $report->obstacles;
            if (!is_null($report->photo_path))       $jsonData['photo_path'] = $report->photo_path;
            if (!is_null($report->video_path))       $jsonData['video_path'] = $report->video_path;
            if (!empty($instructions))               $jsonData['instructions_done'] = $instructions;

            DB::table('report_progress')
                ->where('id', $report->id)
                ->update(['progress_information' => json_encode($jsonData)]);
        }

        // Hapus kolom baru
        Schema::table('report_progress', function (Blueprint $table) {
            $table->dropColumn(['description', 'progress_percent', 'obstacles', 'photo_path', 'video_path']);
        });

        // Drop tabel instructions
        Schema::dropIfExists('report_instructions_done');
    }
};
