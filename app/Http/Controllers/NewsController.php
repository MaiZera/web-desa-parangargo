<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index(Request $request)
    {
        $query = News::with('author')->latest('published_at');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $news = $query->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news article.
     */
    public function create()
    {
        $categories = $this->getCategories();
        $authors = User::select('id', 'name')->get();
        
        return view('admin.news.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created news article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Set author
        $validated['author_id'] = auth()->id();

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['title']);

        // Set published_at if publishing
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Display the specified news article.
     */
    public function show(News $news)
    {
        $news->load('author');
        
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified news article.
     */
    public function edit(News $news)
    {
        $categories = $this->getCategories();
        $authors = User::select('id', 'name')->get();
        
        return view('admin.news.edit', compact('news', 'categories', 'authors'));
    }

    /**
     * Update the specified news article.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Update slug if title changed
        if ($news->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set published_at if status changed to published
        if ($validated['status'] === 'published' && $news->status !== 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified news article (soft delete).
     */
    public function destroy(News $news)
    {
        // Delete image
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Publish a news article.
     */
    public function publish(News $news)
    {
        $news->update([
            'status' => 'published',
            'published_at' => $news->published_at ?? now(),
        ]);

        return back()->with('success', 'Berita berhasil dipublikasikan!');
    }

    /**
     * Unpublish a news article.
     */
    public function unpublish(News $news)
    {
        $news->update(['status' => 'draft']);

        return back()->with('success', 'Berita berhasil di-unpublish!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(News $news)
    {
        $news->update(['is_featured' => !$news->is_featured]);

        $message = $news->is_featured ? 'Berita ditandai sebagai unggulan!' : 'Berita dihapus dari unggulan!';
        
        return back()->with('success', $message);
    }

    /**
     * Get news categories.
     */
    private function getCategories()
    {
        return [
            'Pembangunan',
            'Ekonomi',
            'Kesehatan',
            'Kegiatan',
            'Sosial',
            'Budaya',
            'Teknologi',
            'Pemerintahan',
            'Lingkungan',
            'Pariwisata',
            'Pendidikan',
            'Lainnya',
        ];
    }
}
