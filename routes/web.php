<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pastikan diletakkan di dalam grup middleware 'auth' jika ingin aman
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});

use App\Http\Controllers\ReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    // ... rute employees sebelumnya ...
    Route::resource('reports', ReportController::class);
});

use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
require __DIR__ . '/auth.php';
