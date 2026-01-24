<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Umkm;
use App\Models\LayananPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Global search across multiple models using fulltext search.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return view('search.index', [
                'query' => $query,
                'results' => [],
            ]);
        }

        $results = [];

        // Search in News using fulltext
        $newsResults = News::whereRaw(
            'MATCH(title, summary, content) AGAINST(? IN NATURAL LANGUAGE MODE)',
            [$query]
        )
        ->published()
        ->take(10)
        ->get()
        ->map(function($news) {
            return [
                'type' => 'Berita',
                'title' => $news->title,
                'summary' => $news->summary,
                'url' => route('news.show', $news->slug),
                'date' => $news->published_at,
                'image' => $news->image,
            ];
        });

        // Search in UMKM using fulltext
        $umkmResults = Umkm::whereRaw(
            'MATCH(nama_usaha, deskripsi, produk_layanan) AGAINST(? IN NATURAL LANGUAGE MODE)',
            [$query]
        )
        ->active()
        ->take(10)
        ->get()
        ->map(function($umkm) {
            return [
                'type' => 'UMKM',
                'title' => $umkm->nama_usaha,
                'summary' => $umkm->deskripsi,
                'url' => route('umkm.show', $umkm->slug),
                'date' => $umkm->created_at,
                'image' => $umkm->logo,
            ];
        });

        // Search in Layanan Publik using fulltext
        $layananResults = LayananPublik::whereRaw(
            'MATCH(nama_layanan, deskripsi) AGAINST(? IN NATURAL LANGUAGE MODE)',
            [$query]
        )
        ->where('is_active', true)
        ->take(10)
        ->get()
        ->map(function($layanan) {
            return [
                'type' => 'Layanan Publik',
                'title' => $layanan->nama_layanan,
                'summary' => $layanan->deskripsi,
                'url' => route('layanan.show', $layanan->slug),
                'date' => $layanan->created_at,
                'image' => $layanan->gambar,
            ];
        });

        // Combine and sort results
        $results = collect()
            ->merge($newsResults)
            ->merge($umkmResults)
            ->merge($layananResults)
            ->sortByDesc('date');

        return view('search.index', [
            'query' => $query,
            'results' => $results,
            'newsCount' => $newsResults->count(),
            'umkmCount' => $umkmResults->count(),
            'layananCount' => $layananResults->count(),
        ]);
    }

    /**
     * Search specifically in news.
     */
    public function news(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            $results = News::published()->latest('published_at')->paginate(15);
        } else {
            $results = News::whereRaw(
                'MATCH(title, summary, content) AGAINST(? IN NATURAL LANGUAGE MODE)',
                [$query]
            )
            ->published()
            ->paginate(15);
        }

        return view('search.news', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    /**
     * Search specifically in UMKM.
     */
    public function umkm(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            $results = Umkm::active()->latest()->paginate(15);
        } else {
            $results = Umkm::whereRaw(
                'MATCH(nama_usaha, deskripsi, produk_layanan) AGAINST(? IN NATURAL LANGUAGE MODE)',
                [$query]
            )
            ->active()
            ->paginate(15);
        }

        return view('search.umkm', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    /**
     * Search specifically in Layanan Publik.
     */
    public function layanan(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            $results = LayananPublik::where('is_active', true)
                ->orderBy('urutan')
                ->paginate(15);
        } else {
            $results = LayananPublik::whereRaw(
                'MATCH(nama_layanan, deskripsi) AGAINST(? IN NATURAL LANGUAGE MODE)',
                [$query]
            )
            ->where('is_active', true)
            ->paginate(15);
        }

        return view('search.layanan', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
