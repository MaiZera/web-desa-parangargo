<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    /**
     * Display a listing of sponsors.
     */
    public function index(Request $request)
    {
        $query = Sponsor::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
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

        $sponsors = $query->orderBy('urutan')->paginate(15);
        $categories = $this->getCategories();

        return view('admin.sponsors.index', compact('sponsors', 'categories'));
    }

    /**
     * Show the form for creating a new sponsor.
     */
    public function create()
    {
        $maxUrutan = Sponsor::max('urutan') ?? 0;
        $categories = $this->getCategories();
        
        return view('admin.sponsors.create', compact('maxUrutan', 'categories'));
    }

    /**
     * Store a newly created sponsor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        Sponsor::create($validated);

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor berhasil ditambahkan!');
    }

    /**
     * Display the specified sponsor.
     */
    public function show(Sponsor $sponsor)
    {
        return view('admin.sponsors.show', compact('sponsor'));
    }

    /**
     * Show the form for editing the specified sponsor.
     */
    public function edit(Sponsor $sponsor)
    {
        $categories = $this->getCategories();
        
        return view('admin.sponsors.edit', compact('sponsor', 'categories'));
    }

    /**
     * Update the specified sponsor.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:255',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($sponsor->logo) {
                Storage::disk('public')->delete($sponsor->logo);
            }
            $validated['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        $sponsor->update($validated);

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor berhasil diperbarui!');
    }

    /**
     * Remove the specified sponsor.
     */
    public function destroy(Sponsor $sponsor)
    {
        // Delete logo
        if ($sponsor->logo) {
            Storage::disk('public')->delete($sponsor->logo);
        }

        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Sponsor $sponsor)
    {
        $sponsor->update(['is_active' => !$sponsor->is_active]);

        $message = $sponsor->is_active ? 'Sponsor diaktifkan!' : 'Sponsor dinonaktifkan!';
        
        return back()->with('success', $message);
    }

    /**
     * Reorder sponsors.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:sponsors,id',
            'orders.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            Sponsor::where('id', $order['id'])->update(['urutan' => $order['urutan']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui!']);
    }

    /**
     * Get sponsor categories.
     */
    private function getCategories()
    {
        return [
            'Pemerintah',
            'Swasta',
            'NGO',
            'BUMN',
            'Lainnya',
        ];
    }
}
