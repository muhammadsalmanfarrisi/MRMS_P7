<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Halaman depan (bebas diakses siapa saja)
Route::get('/', function () {
    return view('welcome');
});

// =============================================
// SEMUA MENU / HALAMAN APLIKASI HANYA UNTUK ADMIN
// =============================================
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tasks/overdue', [TaskController::class, 'overdue'])->name('tasks.overdue');
    Route::resource('employees', EmployeeController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('admins', AdminController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');



    Route::get('/test-notif', function () {
        \App\Models\Task::sendRecentActivitiesToTelegramGroup();
        return 'Notif dikirim, cek grup dan log.';
    });
});

// Rute autentikasi (login, register, dll.) → bebas diakses siapapun
require __DIR__ . '/auth.php';
