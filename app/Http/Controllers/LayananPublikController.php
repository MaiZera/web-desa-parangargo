<?php

namespace App\Http\Controllers;

use App\Models\LayananPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananPublikController extends Controller
{
    /**
     * Display a listing of public services.
     */
    public function index(Request $request)
    {
        $query = LayananPublik::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_layanan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $layanan = $query->orderBy('urutan')->paginate(15);

        return view('admin.layanan-publik.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $maxUrutan = LayananPublik::max('urutan') ?? 0;
        
        return view('admin.layanan-publik.create', compact('maxUrutan'));
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'waktu_proses' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'penanggung_jawab' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['nama_layanan']);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        LayananPublik::create($validated);

        return redirect()->route('admin.layanan-publik.index')
            ->with('success', 'Layanan publik berhasil ditambahkan!');
    }

    /**
     * Display the specified service.
     */
    public function show(LayananPublik $layananPublik)
    {
        return view('admin.layanan-publik.show', compact('layananPublik'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(LayananPublik $layananPublik)
    {
        return view('admin.layanan-publik.edit', compact('layananPublik'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, LayananPublik $layananPublik)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'waktu_proses' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'penanggung_jawab' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        // Update slug if name changed
        if ($layananPublik->nama_layanan !== $validated['nama_layanan']) {
            $validated['slug'] = Str::slug($validated['nama_layanan']);
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($layananPublik->gambar) {
                Storage::disk('public')->delete($layananPublik->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layananPublik->update($validated);

        return redirect()->route('admin.layanan-publik.index')
            ->with('success', 'Layanan publik berhasil diperbarui!');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(LayananPublik $layananPublik)
    {
        // Delete image
        if ($layananPublik->gambar) {
            Storage::disk('public')->delete($layananPublik->gambar);
        }

        $layananPublik->delete();

        return redirect()->route('admin.layanan-publik.index')
            ->with('success', 'Layanan publik berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(LayananPublik $layananPublik)
    {
        $layananPublik->update(['is_active' => !$layananPublik->is_active]);

        $message = $layananPublik->is_active ? 'Layanan diaktifkan!' : 'Layanan dinonaktifkan!';
        
        return back()->with('success', $message);
    }

    /**
     * Reorder services.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:layanan_publik,id',
            'orders.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            LayananPublik::where('id', $order['id'])->update(['urutan' => $order['urutan']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui!']);
    }
}
