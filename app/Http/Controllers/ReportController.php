<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // 1. TAMPILKAN SEMUA LAPORAN
    public function index()
    {
        // Menampilkan laporan dari yang paling baru
        $reports = Task::where('status', 'unprocessed')->latest()->get();
        return view('reports.index', compact('reports'));
    }

    // 2. TAMPILKAN FORM LAPORAN
    public function create()
    {
        return view('reports.create');
    }

    // 3. PROSES SIMPAN LAPORAN BARU
    public function store(Request $request)
    {
        // Validasi input dan file
        $request->validate([
            'damaged_tool' => 'required|string|max:255',
            'cause'        => 'nullable|string',
            'description'  => 'required|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maks 5MB
            'video'        => 'nullable|mimetypes:video/mp4,video/quicktime|max:20480', // Maks 20MB
        ]);

        // Logika simpan foto (jika ada)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reports/photos', 'public');
        }

        // Logika simpan video (jika ada)
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('reports/videos', 'public');
        }

        // Simpan ke database dengan isian otomatis
        Task::create([
            'damaged_tool'  => $request->damaged_tool,
            'cause'         => $request->cause,
            'description'   => $request->description,
            'photo_url'     => $photoPath,
            'video_url'     => $videoPath,
            'reporter_name' => Auth::user()->name, // Otomatis nama yang login
            'report_time'   => now(),              // Otomatis waktu saat ini
            'status'        => 'unprocessed',  // Otomatis status awal
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan kerusakan berhasil dikirim!');
    }

    // 4. HAPUS LAPORAN
    public function destroy(Task $report) // Menggunakan parameter $report karena URL-nya /reports
    {
        // Hapus file fisik foto jika ada
        if ($report->photo_url) {
            Storage::disk('public')->delete($report->photo_url);
        }
        // Hapus file fisik video jika ada
        if ($report->video_url) {
            Storage::disk('public')->delete($report->video_url);
        }

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }

    // (Abaikan fungsi edit & update untuk pelapor saat ini, biasanya laporan tidak diubah oleh pelapor jika sudah masuk sistem)
}
