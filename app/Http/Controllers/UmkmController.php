<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    /**
     * Display a listing of UMKMs.
     */
    public function index(Request $request)
    {
        $query = Umkm::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('produk_layanan', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $umkm = $query->latest()->paginate(15);
        $categories = $this->getCategories();

        return view('admin.umkm.index', compact('umkm', 'categories'));
    }

    /**
     * Show the form for creating a new UMKM.
     */
    public function create()
    {
        $categories = $this->getCategories();
        
        return view('admin.umkm.create', compact('categories'));
    }

    /**
     * Store a newly created UMKM.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'produk_layanan' => 'nullable|string',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kisaran_harga_min' => 'nullable|numeric|min:0',
            'kisaran_harga_max' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['nama_usaha']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('umkm/logo', 'public');
        }

        // Handle product photo upload
        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $request->file('foto_produk')->store('umkm/produk', 'public');
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Data UMKM berhasil ditambahkan!');
    }

    /**
     * Display the specified UMKM.
     */
    public function show(Umkm $umkm)
    {
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified UMKM.
     */
    public function edit(Umkm $umkm)
    {
        $categories = $this->getCategories();
        
        return view('admin.umkm.edit', compact('umkm', 'categories'));
    }

    /**
     * Update the specified UMKM.
     */
    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'produk_layanan' => 'nullable|string',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kisaran_harga_min' => 'nullable|numeric|min:0',
            'kisaran_harga_max' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Update slug if name changed
        if ($umkm->nama_usaha !== $validated['nama_usaha']) {
            $validated['slug'] = Str::slug($validated['nama_usaha']);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }
            $validated['logo'] = $request->file('logo')->store('umkm/logo', 'public');
        }

        // Handle product photo upload
        if ($request->hasFile('foto_produk')) {
            // Delete old photo
            if ($umkm->foto_produk) {
                Storage::disk('public')->delete($umkm->foto_produk);
            }
            $validated['foto_produk'] = $request->file('foto_produk')->store('umkm/produk', 'public');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Data UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified UMKM (soft delete).
     */
    public function destroy(Umkm $umkm)
    {
        // Delete logo
        if ($umkm->logo) {
            Storage::disk('public')->delete($umkm->logo);
        }

        // Delete product photo
        if ($umkm->foto_produk) {
            Storage::disk('public')->delete($umkm->foto_produk);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Data UMKM berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Umkm $umkm)
    {
        $umkm->update(['is_active' => !$umkm->is_active]);

        $message = $umkm->is_active ? 'UMKM diaktifkan!' : 'UMKM dinonaktifkan!';
        
        return back()->with('success', $message);
    }

    /**
     * Get UMKM categories.
     */
    private function getCategories()
    {
        return [
            'Kuliner',
            'Kerajinan',
            'Jasa',
            'Perdagangan',
            'Pertanian',
            'Peternakan',
            'Fashion',
            'Teknologi',
            'Lainnya',
        ];
    }
}
