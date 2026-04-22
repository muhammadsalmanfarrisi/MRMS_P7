<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TelegramReportController extends Controller
{
    public function storeReport(Request $request)
    {
        // 1. Validasi data yang masuk dari bot Python
        $validator = Validator::make($request->all(), [
            'reporter_name' => 'required|string',
            'damaged_tool' => 'required|string',
            'description' => 'required|string',
            'cause' => 'nullable|string',
            'photo_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'telegram_user_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // 2. Simpan data ke database (menggunakan model Task)
        try {
            $task = Task::create([
                'reporter_name' => $request->reporter_name,
                'damaged_tool' => $request->damaged_tool,
                'description' => $request->description,
                'cause' => $request->cause,
                'photo_url' => $request->photo_url,
                'video_url' => $request->video_url,
                'report_time' => now(),
                'status' => 'pending', // Set status awal
                'additional_info' => json_encode(['telegram_user_id' => $request->telegram_user_id]) // Simpan info tambahan jika perlu
            ]);

            Log::info("New report stored from Telegram bot", ['task_id' => $task->id]);
            return response()->json(['message' => 'Report stored successfully', 'task_id' => $task->id], 200);
        } catch (\Exception $e) {
            Log::error("Failed to store report from Telegram bot: " . $e->getMessage());
            return response()->json(['message' => 'Failed to store report'], 500);
        }
    }
}
