<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Staff;
use App\Models\ProfileDesa;

class PageController extends Controller
{
    public function about()
    {
        $staff = Staff::where('is_active', true)->orderBy('urutan')->get();
        $profile = ProfileDesa::first();
        $demografis = \App\Models\Demografis::first();
        return view('pages.about', compact('staff', 'profile', 'demografis'));
    }

    public function services()
    {
        return view('pages.services');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function artikel(Request $request)
    {
        $query = \App\Models\News::with(['categories', 'author'])->published();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '' && $request->category != 'Semua') {
            $categorySlug = $request->category;
            $query->whereHas('categories', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $news = $query->latest('published_at')->paginate(9);
        $categories = \App\Models\Category::all();

        if ($request->ajax()) {
            return view('pages.partials.news-grid', compact('news'))->render();
        }

        return view('pages.artikel', compact('news', 'categories'));
    }

    public function pengumuman(Request $request)
    {
        $query = \App\Models\Announcement::active()->orderBy('created_at', 'desc');

        if ($request->has('tipe') && $request->tipe != '' && $request->tipe != 'Semua') {
            $query->where('tipe', $request->tipe);
        }

        $announcements = $query->paginate(10);

        if ($request->ajax()) {
            return view('pages.partials.announcement-list', compact('announcements'))->render();
        }

        return view('pages.pengumuman', compact('announcements'));
    }

    public function announcementDetail($slug)
    {
        return view('pages.announcement-detail');
    }

    public function laporan()
    {
        return view('pages.laporan');
    }

    public function newsDetail($slug)
    {
        return view('pages.news-detail');
    }


    public function transparency()
    {
        $transparency = \App\Models\Transparency::orderBy('created_at', 'desc')->get();
        return view('pages.transparency', compact('transparency'));
    }

    public function umkm(Request $request)
    {
        $query = \App\Models\Umkm::active()->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('produk_layanan', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('kategori') && $request->kategori != '' && $request->kategori != 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        $umkms = $query->paginate(9);
        $categories = \App\Models\Umkm::select('kategori')->distinct()->pluck('kategori');

        // Add 'Semua' to categories if not present (handled in view usually, but good to have raw list)
        // actually simplest is just passing $categories from DB and adding 'Semua' in the view manually.

        if ($request->ajax()) {
            return view('pages.partials.umkm-list', compact('umkms'))->render();
        }

        return view('pages.umkm', compact('umkms', 'categories'));
    }

    public function participation()
    {
        return view('pages.participation');
    }

    public function gallery(Request $request)
    {
        // 1. Fetch from Activity Gallery (Admin uploads)
        // Map to common structure
        $activities = \App\Models\Galeri::latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'act_' . $item->id, // unique ID
                    'title' => $item->judul,
                    'category' => $item->kategori, // e.g., 'Kegiatan', 'Infrastruktur'
                    'image' => asset('storage/' . $item->gambar),
                    'type' => 'activity',
                    'date' => $item->created_at,
                    'description' => $item->deskripsi
                ];
            });

        // 2. Fetch from News (Berita)
        // Map to common structure
        $news = \App\Models\News::whereNotNull('image')
            ->published()
            ->latest('published_at')
            ->get()
            ->map(function ($item) {
                // Determine category based on your app logic, or default to 'Berita'
                // If News has categories relation: $item->categories->first()->name ?? 'Berita'
                return [
                    'id' => 'news_' . $item->id,
                    'title' => $item->title,
                    'category' => 'Berita',
                    'image' => asset('storage/' . $item->image),
                    'type' => 'news',
                    'date' => $item->published_at,
                    'description' => $item->summary ?? Str::limit(strip_tags($item->content), 100)
                ];
            });

        // 3. Merge Collections
        $items = $activities->concat($news)->sortByDesc('date')->values();

        // 4. Get unique categories for filter
        // Start with default/static categories if needed, or just extract from items
        $categories = $items->pluck('category')->unique()->values()->prepend('Semua');

        return view('pages.gallery', compact('items', 'categories'));
    }

    public function profileDesa()
    {
        return view('pages.profile-desa');
    }

    public function demografis()
    {
        return view('pages.demografis');
    }

    public function strukturDesa()
    {
        $staff = Staff::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.struktur-desa', compact('staff'));
    }

    public function maps()
    {
        return view('pages.maps');
    }
}
