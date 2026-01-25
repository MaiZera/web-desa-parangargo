<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProfileDesaController;
use App\Http\Controllers\Admin\DemografisController;

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

// Tentang Desa Dropdown Routes
Route::get('/profile-desa', [PageController::class, 'profileDesa'])->name('profile-desa');
Route::get('/demografis', [PageController::class, 'demografis'])->name('demografis');
Route::get('/struktur-desa', [PageController::class, 'strukturDesa'])->name('struktur-desa');
Route::get('/maps', [PageController::class, 'maps'])->name('maps');

Route::get('/dashboard', function () {
    $banners = \App\Models\Banner::where('is_active', true)->latest()->get();
    return view('dashboard', compact('banners'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('banners', BannerController::class);
        Route::resource('staff', StaffController::class);
        
        // Profile Desa routes
        Route::get('profile-desa/edit', [ProfileDesaController::class, 'edit'])->name('profile-desa.edit');
        Route::put('profile-desa', [ProfileDesaController::class, 'update'])->name('profile-desa.update');
        
        // Demografis routes
        Route::get('demografis/edit', [DemografisController::class, 'edit'])->name('demografis.edit');
        Route::put('demografis', [DemografisController::class, 'update'])->name('demografis.update');
    });
});

require __DIR__.'/auth.php';
