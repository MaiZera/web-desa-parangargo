<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of gallery photos.
     */
    public function index(Request $request)
    {
        $query = Galeri::with('uploader')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $galeri = $query->paginate(15);
        $categories = $this->getCategories();

        return view('admin.gallery.index', compact('galeri', 'categories'));
    }

    /**
     * Show the form for creating a new gallery photo.
     */
    public function create()
    {
        $categories = $this->getCategories();

        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created gallery photo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'kategori' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'tanggal_foto' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');

        // Set uploader
        $validated['uploaded_by'] = auth()->id();

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    /**
     * Display the specified gallery photo.
     */
    public function show(Galeri $galeri)
    {
        $galeri->load('uploader');

        return view('admin.gallery.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified gallery photo.
     */
    public function edit(Galeri $galeri)
    {
        $categories = $this->getCategories();

        return view('admin.gallery.edit', compact('galeri', 'categories'));
    }

    /**
     * Update the specified gallery photo.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'kategori' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'tanggal_foto' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diperbarui!');
    }

    /**
     * Remove the specified gallery photo (soft delete).
     */
    public function destroy(Galeri $galeri)
    {
        // Delete image
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Galeri $galeri)
    {
        $galeri->update(['is_featured' => !$galeri->is_featured]);

        $message = $galeri->is_featured ? 'Foto ditandai sebagai unggulan!' : 'Foto dihapus dari unggulan!';

        return back()->with('success', $message);
    }

    /**
     * Get gallery categories.
     */
    private function getCategories()
    {
        return [
            'Kegiatan',
            'Infrastruktur',
            'Alam',
            'Budaya',
            'UMKM',
            'Pendidikan',
            'Kesehatan',
            'Pemerintahan',
            'Lainnya',
        ];
    }
}
