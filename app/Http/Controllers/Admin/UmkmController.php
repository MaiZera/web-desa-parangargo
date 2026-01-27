<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::latest()->paginate(10);
        return view('admin.umkm.index', compact('umkms'));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('umkm', 'public');
            $validated['foto_produk'] = $path;
        }

        // Slug is handled by Mutator in Model, but we can double check or explicit set it here if needed.
        // The model setter: $this->attributes['slug'] = Str::slug($value); upon setting nama_usaha.
        // So just creating with 'nama_usaha' triggers it.

        $validated['is_active'] = $request->has('is_active'); // checkbox handling
        
        // Auto-fill whatsapp with same number as telepon since we merged the input
        if (isset($validated['telepon'])) {
            $validated['whatsapp'] = $validated['telepon'];
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('foto_produk')) {
            // Delete old image
            if ($umkm->foto_produk) {
                Storage::disk('public')->delete($umkm->foto_produk);
            }
            $path = $request->file('foto_produk')->store('umkm', 'public');
            $validated['foto_produk'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        // Auto-fill whatsapp with same number as telepon since we merged the input
        if (isset($validated['telepon'])) {
            $validated['whatsapp'] = $validated['telepon'];
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        if ($umkm->foto_produk) {
            Storage::disk('public')->delete($umkm->foto_produk);
        }
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }
}
