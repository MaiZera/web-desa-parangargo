<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Category; // Ensure this is imported at the top

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['author', 'categories'])->latest();

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $categories = (array) $request->input('category');

            // Filter out empty values
            $categories = array_filter($categories);

            if (!empty($categories)) {
                $query->whereHas('categories', function ($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            }
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $news = $query->paginate(10);
        $allCategories = Category::all();

        return view('admin.news.index', compact('news', 'allCategories'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['image', 'categories']);
        $data['slug'] = Str::slug($request->title);
        $data['author_id'] = auth()->id();
        $data['summary'] = Str::limit(strip_tags($request->input('content')), 150);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news = News::create($data);

        if ($request->has('categories')) {
            $news->categories()->sync($request->categories);
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $news = News::with('categories')->findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['image', 'categories']);
        $data['slug'] = Str::slug($request->title);
        $data['summary'] = Str::limit(strip_tags($request->input('content')), 150);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        if ($request->has('categories')) {
            $news->categories()->sync($request->categories);
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function autosave(Request $request)
    {
        // Validation minimal
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable',
        ]);

        $data = $request->except(['categories', 'image', 'news_id']); // Image file can't be autosaved easily via simple AJAX unless FormData is perfect.
        // For autosave we might skip image upload or handle it if FormData is passed.
        // Assuming FormData is passed.

        $data['slug'] = Str::slug($request->title);
        $data['summary'] = Str::limit(strip_tags($request->input('content')), 150);
        $data['status'] = 'draft';
        $data['author_id'] = auth()->id();

        // Check if updating or creating
        if ($request->filled('news_id')) {
            $news = News::find($request->news_id);
            if ($news) {
                $news->update($data);
                if ($request->has('categories')) {
                    $news->categories()->sync($request->categories);
                }
                return response()->json(['status' => 'success', 'id' => $news->id, 'action' => 'update']);
            }
        }

        // Create new
        $news = News::create($data);
        if ($request->has('categories')) {
            $news->categories()->sync($request->categories);
        }

        return response()->json(['status' => 'success', 'id' => $news->id, 'action' => 'create']);
    }

    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
