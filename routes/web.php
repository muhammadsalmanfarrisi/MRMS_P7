<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pastikan diletakkan di dalam grup middleware 'auth' jika ingin aman
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});



Route::middleware(['auth', 'verified'])->group(function () {
    // ... rute employees sebelumnya ...
    Route::resource('reports', ReportController::class);
});



Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});

Route::get('/test-notif', function () {
    \App\Models\Task::sendRecentActivitiesToTelegramGroup();
    return 'Notif dikirim, cek grup dan log.';
});

require __DIR__ . '/auth.php';
