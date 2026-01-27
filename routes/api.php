<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\UmkmController;

Route::get('/agendas', [AgendaController::class, 'index']);
Route::get('/agendas/upcoming', [AgendaController::class, 'upcoming']);

Route::get('/umkms', [UmkmController::class, 'index']);
Route::get('/umkms/{umkm}', [UmkmController::class, 'show']);
