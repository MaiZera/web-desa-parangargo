<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Announcement;

class SitemapController extends Controller
{
    public function index()
    {
        // Get all published news
        $newsItems = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        // Get all announcements
        $announcements = Announcement::orderBy('created_at', 'desc')->get();

        // Define static pages
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('about'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => route('services'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('news'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('news.artikel'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('news.pengumuman'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('news.laporan'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('transparency'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('umkm'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('gallery'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => route('participation'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add static pages
        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($page['url']) . '</loc>';
            $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';
            $xml .= '</url>';
        }

        // Add news items
        foreach ($newsItems as $news) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars(route('news.show', $news->slug)) . '</loc>';
            $xml .= '<lastmod>' . $news->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Add announcements
        foreach ($announcements as $announcement) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars(route('news.announcement.show', $announcement->slug)) . '</loc>';
            $xml .= '<lastmod>' . $announcement->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
