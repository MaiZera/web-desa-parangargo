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
                'category_type' => 'Berita',
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
                'status' => $item->status,
                'image' => null,
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
            ->take(7);

        return view('dashboard', compact(
            'newsStats',
            'umkmStats',
            'visitStats',
            'totalPenduduk',
            'banners',
            'recentContent'
        ));
    }

    private function getStats($modelClass, $filters = [])
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth();

        $query = $modelClass::query();
        if (!empty($filters)) {
            $query->where($filters);
        }
        $total = $query->count();

        $countThisMonth = $modelClass::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear);
        if (!empty($filters)) {
            $countThisMonth->where($filters);
        }
        $countThisMonth = $countThisMonth->count();

        $countLastMonth = $modelClass::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year);
        if (!empty($filters)) {
            $countLastMonth->where($filters);
        }
        $countLastMonth = $countLastMonth->count();

        $change = 0;
        $trend = 'neutral';

        if ($countLastMonth > 0) {
            $change = (($countThisMonth - $countLastMonth) / $countLastMonth) * 100;
        } else if ($countThisMonth > 0) {
            $change = 100;
        }

        if ($change > 0)
            $trend = 'up';
        if ($change < 0)
            $trend = 'down';

        return [
            'total' => $total,
            'change' => round(abs($change), 1),
            'trend' => $trend
        ];
    }
}
