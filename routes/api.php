<?php

use App\Http\Controllers\TelegramReportController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/store-report', [TelegramReportController::class, 'storeReport']);
