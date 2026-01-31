<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProfileDesaController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\DemografisController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;


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

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
// Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/berita/artikel', [PageController::class, 'artikel'])->name('news.artikel');
Route::get('/berita/pengumuman', [PageController::class, 'pengumuman'])->name('news.pengumuman');
Route::get('/berita/pengumuman/{slug}', [PageController::class, 'announcementDetail'])->name('news.announcement.show');
Route::get('/berita/laporan', [PageController::class, 'laporan'])->name('news.laporan');
Route::get('/berita/{slug}', [PageController::class, 'newsDetail'])->name('news.show');
Route::get('/transparansi', [PageController::class, 'transparency'])->name('transparency');
Route::get('/umkm', [PageController::class, 'umkm'])->name('umkm');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/partisipasi', [PageController::class, 'participation'])->name('participation');
Route::post('/feedback/submit', [\App\Http\Controllers\FeedbackController::class, 'submit'])->name('feedback.submit');

Route::get('/banner', [App\Http\Controllers\BannerController::class, 'index'])->name('banner.index');
Route::get('/banner/{banner}', [App\Http\Controllers\BannerController::class, 'show'])->name('banner.show');

Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('banners', BannerController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('agendas', AdminAgendaController::class);
        Route::resource('announcements', AnnouncementController::class);

        // Profile Desa routes
        Route::get('profile-desa/edit', [ProfileDesaController::class, 'edit'])->name('profile-desa.edit');
        Route::put('profile-desa', [ProfileDesaController::class, 'update'])->name('profile-desa.update');

        // Kontak Desa routes
        Route::get('contact-info/edit', [ContactInfoController::class, 'edit'])->name('contact-info.edit');
        Route::put('contact-info', [ContactInfoController::class, 'update'])->name('contact-info.update');

        // Demografis routes
        Route::get('demografis/edit', [DemografisController::class, 'edit'])->name('demografis.edit');
        Route::put('demografis', [DemografisController::class, 'update'])->name('demografis.update');

        Route::resource('umkm', \App\Http\Controllers\Admin\UmkmController::class);

        // Custom routes for AJAX
        Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::post('categories/store', [CategoryController::class, 'store']); // Match JS URL
        Route::post('news/autosave', [NewsController::class, 'autosave'])->name('news.autosave');
        Route::post('news/upload-image', [NewsController::class, 'uploadImage'])->name('news.upload-image');

        Route::resource('announcements', AnnouncementController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('news', NewsController::class);

        // Feedback Routes
        Route::get('feedback', [\App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('feedback/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'show'])->name('feedback.show');
        Route::delete('feedback/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'destroy'])->name('feedback.destroy');
        Route::put('feedback/{feedback}/status', [\App\Http\Controllers\FeedbackController::class, 'updateStatus'])->name('feedback.update-status');
        Route::get('feedback/{feedback}/respond', [\App\Http\Controllers\FeedbackController::class, 'respond'])->name('feedback.respond');
        Route::put('feedback/{feedback}/respond', [\App\Http\Controllers\FeedbackController::class, 'storeResponse'])->name('feedback.store-response');
        Route::put('feedback/{feedback}/complete', [\App\Http\Controllers\FeedbackController::class, 'complete'])->name('feedback.complete');

        Route::resource('sponsors', \App\Http\Controllers\SponsorController::class);
        Route::resource('transparency', \App\Http\Controllers\Admin\TransparencyController::class);

        Route::resource('accounts', \App\Http\Controllers\Admin\AccountController::class);
        Route::patch('galeri/{galeri}/toggle-featured', [\App\Http\Controllers\GaleriController::class, 'toggleFeatured'])->name('galeri.toggle-featured');
        Route::resource('galeri', \App\Http\Controllers\GaleriController::class);
        Route::resource('project-reports', \App\Http\Controllers\Admin\ProjectReportController::class);
    });
});

require __DIR__ . '/auth.php';
