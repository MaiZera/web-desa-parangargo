<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Demografis;
use App\Models\Umkm;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // For debugging, let's verify if view exists or fallback to welcome
        $banners = Banner::where('is_active', true)->latest()->get();

        // Demografi
        $demografi = Demografis::first();
        $pendudukCount = $demografi ? $demografi->jumlah_penduduk : 0;

        // UMKM
        // Count active UMKM
        $umkmCount = Umkm::active()->count();
        // Get latest active UMKMs (e.g., 6 items)
        $umkms = Umkm::active()->latest()->take(6)->get();

        // News
        // Get latest published news (e.g., 3 items)
        $news = News::published()->latest()->take(3)->get();

        // Agenda
        // Get upcoming agendas (e.g., 4 items)
        $upcoming_agendas = \App\Models\Agenda::upcoming()->take(4)->get();

        if (view()->exists('pages.home')) {
            return view('pages.home', compact('banners', 'pendudukCount', 'umkmCount', 'umkms', 'news', 'upcoming_agendas'));
        }
        return view('welcome', compact('banners'));
    }
}
