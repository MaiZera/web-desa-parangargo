<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('nama_pemilik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('kategori', $request->category);
        }

        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $umkms = $query->paginate(10);
        $categories = Umkm::select('kategori')->distinct()->pluck('kategori');

        return view('admin.umkm.index', compact('umkms', 'categories'));
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
            'produk_layanan' => 'nullable|array',
            'produk_layanan.*' => 'string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
            'kisaran_harga_min' => 'nullable|numeric|min:0',
            'kisaran_harga_max' => 'nullable|numeric|min:0|gte:kisaran_harga_min',
            'jam_buka' => 'nullable|array',
        ], [
            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'kategori.required' => 'Kategori usaha wajib dipilih.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'foto_produk.image' => 'File harus berupa gambar.',
            'foto_produk.max' => 'Ukuran gambar maksimal 2MB.',
            'kisaran_harga_max.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
            'produk_layanan.*.string' => 'Produk/Layanan harus berupa teks dan berisi.',
            'produk_layanan.*.max' => 'Nama produk/layanan terlalu panjang.',
        ]);

        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('umkm', 'public');
            $validated['foto_produk'] = $path;
        }

        // Slug is handled by Mutator in Model

        $validated['is_active'] = $request->has('is_active'); // checkbox handling

        // Auto-fill whatsapp with same number as telepon since we merged the input
        if (isset($validated['telepon'])) {
            $validated['whatsapp'] = $validated['telepon'];
        }

        // Remove empty values from produk_layanan (if any empty strings submitted)
        if (isset($validated['produk_layanan'])) {
            $validated['produk_layanan'] = array_filter($validated['produk_layanan'], fn($value) => !is_null($value) && $value !== '');
            // Re-index array to ensure it saves as list not object if keys are missing
            $validated['produk_layanan'] = array_values($validated['produk_layanan']);
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
            'produk_layanan' => 'nullable|array',
            'produk_layanan.*' => 'string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
            'kisaran_harga_min' => 'nullable|numeric|min:0',
            'kisaran_harga_max' => 'nullable|numeric|min:0|gte:kisaran_harga_min',
            'jam_buka' => 'nullable|array',
        ], [
            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'kategori.required' => 'Kategori usaha wajib dipilih.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'foto_produk.image' => 'File harus berupa gambar.',
            'foto_produk.max' => 'Ukuran gambar maksimal 2MB.',
            'kisaran_harga_max.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
            'produk_layanan.*.string' => 'Produk/Layanan harus berupa teks.',
            'produk_layanan.*.max' => 'Nama produk/layanan terlalu panjang.',
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

        // Remove empty values from produk_layanan (if any empty strings submitted)
        if (isset($validated['produk_layanan'])) {
            $validated['produk_layanan'] = array_filter($validated['produk_layanan'], fn($value) => !is_null($value) && $value !== '');
            $validated['produk_layanan'] = array_values($validated['produk_layanan']);
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
