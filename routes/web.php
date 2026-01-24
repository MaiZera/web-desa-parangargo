<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/transparansi', [PageController::class, 'transparency'])->name('transparency');
Route::get('/umkm', [PageController::class, 'umkm'])->name('umkm');
Route::get('/partisipasi', [PageController::class, 'participation'])->name('participation');
