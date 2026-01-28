<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Demografis;
use App\Models\News;
use App\Models\Umkm;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Berita & Comparison
        $newsStats = $this->getStats(News::class);

        // 2. Total UMKM & Comparison
        $umkmStats = $this->getStats(Umkm::class);

        // 3. Visits & Comparison
        $visitStats = $this->getStats(Visitor::class);

        // 4. Penduduk (Total)
        $demografis = Demografis::first();
        $totalPenduduk = $demografis ? $demografis->jumlah_penduduk : 0;

        // 5. Banners
        $banners = Banner::where('is_active', true)->latest()->get();

        // 6. Recent Content (News, Announcement, UMKM)
        $recentNews = News::latest()->take(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'category_type' => 'Berita', // Label for display
                'date' => $item->created_at,
                'status' => $item->status,
                'image' => $item->image,
                'edit_route' => route('admin.news.edit', $item->id),
                'delete_route' => route('admin.news.destroy', $item->id),
                'type' => 'news'
            ];
        });

        $recentAnnouncements = Announcement::latest()->take(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->judul,
                'category_type' => 'Pengumuman',
                'date' => $item->created_at,
                'status' => $item->status, // published/draft
                'image' => null, // Announcements might not have cover images easily accessible or different logic
                'edit_route' => route('admin.announcements.edit', $item->id),
                'delete_route' => route('admin.announcements.destroy', $item->id),
                'type' => 'announcement'
            ];
        });

        $recentUmkm = Umkm::latest()->take(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->nama_usaha,
                'category_type' => 'UMKM',
                'date' => $item->created_at,
                'status' => $item->is_active ? 'Active' : 'Inactive',
                'image' => $item->foto_produk,
                'edit_route' => route('admin.umkm.edit', $item->id),
                'delete_route' => route('admin.umkm.destroy', $item->id),
                'type' => 'umkm'
            ];
        });

        // Merge and Sort
        $recentContent = $recentNews->concat($recentAnnouncements)->concat($recentUmkm)
            ->sortByDesc('date')
            ->take(7); // Show top 7 mixed items

        return view('dashboard', compact(
            'newsStats',
            'umkmStats',
            'visitStats',
            'totalPenduduk',
            'banners',
            'recentContent'
        ));
    }

    private function getStats($modelClass)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $total = $modelClass::count();

        // Calculate counts for current month vs last month to determine trend (growth)
        // Wait, "growth" usually compares "This Month vs Last Month" OR "Total now vs Total Month Ago".
        // The image shows "Total Berita: 120, +10% vs last month".
        // This implies Total Increase. Or it implies "New items this month compared to new items last month"?
        // Usually, for "Total Count" widgets, the percentage shows the rate of *growth* of the total.
        // OR it shows "New items added this period".
        // Let's assume it means "New items this month vs New items last month" if the metric is "Activity".
        // BUT the label is "Total Berita". If "Total" is 120. +10% means we added 10% more... relative to what?
        // Let's implement: count of items created "This Month" vs "Last Month".
        // If "This Month" > "Last Month", then it's an upward trend.
        // Percentage = ((ThisMonth - LastMonth) / LastMonth) * 100.
        // Let's try that.

        $countThisMonth = $modelClass::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $countLastMonth = $modelClass::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $change = 0;
        $trend = 'neutral'; // up, down, neutral

        if ($countLastMonth > 0) {
            $change = (($countThisMonth - $countLastMonth) / $countLastMonth) * 100;
        } else if ($countThisMonth > 0) {
            $change = 100; // 100% increase if last month was 0
        }

        if ($change > 0)
            $trend = 'up';
        if ($change < 0)
            $trend = 'down';

        return [
            'total' => $total,
            'change' => round(abs($change), 1), // Absolute value for display
            'trend' => $trend
        ];
    }
}
