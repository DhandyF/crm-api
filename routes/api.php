<?php

use App\Http\Controllers\CallLogsController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Contact
Route::get('/contact', [ContactController::class, 'get_list']);
Route::put('/contact/{id}', [ContactController::class, 'update']);

// Call Logs
Route::post('/log', [CallLogsController::class, 'add']);
Route::get('/log', [CallLogsController::class, 'get_list']);
