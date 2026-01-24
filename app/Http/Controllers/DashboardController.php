<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Umkm;
use App\Models\Staff;
use App\Models\Agenda;
use App\Models\Feedback;
use App\Models\SuratDomisili;
use App\Models\SuratKeteranganUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Statistics
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('status', 'published')->count(),
            'total_umkm' => Umkm::count(),
            'active_umkm' => Umkm::where('is_active', true)->count(),
            'total_staff' => Staff::count(),
            'active_staff' => Staff::where('is_active', true)->count(),
            'upcoming_agenda' => Agenda::where('status', 'scheduled')
                ->where('tanggal_mulai', '>=', now())
                ->count(),
            'total_feedback' => Feedback::count(),
            'unread_feedback' => Feedback::where('status', 'baru')->count(),
            'pending_surat_domisili' => SuratDomisili::where('status', 'pending')->count(),
            'pending_surat_usaha' => SuratKeteranganUsaha::where('status', 'pending')->count(),
        ];

        // Recent News
        $recentNews = News::with('author')
            ->latest('published_at')
            ->take(5)
            ->get();

        // Recent Feedback
        $recentFeedback = Feedback::latest()
            ->take(5)
            ->get();

        // Upcoming Events
        $upcomingEvents = Agenda::where('status', 'scheduled')
            ->where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai')
            ->take(5)
            ->get();

        // Pending Applications
        $pendingDomisili = SuratDomisili::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $pendingUsaha = SuratKeteranganUsaha::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // News by Category (for chart)
        $newsByCategory = News::select('category', DB::raw('count(*) as total'))
            ->whereNotNull('category')
            ->groupBy('category')
            ->get();

        // UMKM by Category (for chart)
        $umkmByCategory = Umkm::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentNews',
            'recentFeedback',
            'upcomingEvents',
            'pendingDomisili',
            'pendingUsaha',
            'newsByCategory',
            'umkmByCategory'
        ));
    }
}
