<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of agenda/events.
     */
    public function index(Request $request)
    {
        $query = Agenda::latest('tanggal_mulai');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        // Filter by month
        if ($request->filled('month') && $request->filled('year')) {
            $query->whereYear('tanggal_mulai', $request->year)
                  ->whereMonth('tanggal_mulai', $request->month);
        }

        $agenda = $query->paginate(15);

        return view('admin.agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new agenda.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created agenda.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'catatan' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('agenda', 'public');
        }

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dibuat!');
    }

    /**
     * Display the specified agenda.
     */
    public function show(Agenda $agenda)
    {
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified agenda.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified agenda.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'catatan' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('agenda', 'public');
        }

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified agenda (soft delete).
     */
    public function destroy(Agenda $agenda)
    {
        // Delete image
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus!');
    }

    /**
     * Update agenda status.
     */
    public function updateStatus(Request $request, Agenda $agenda)
    {
        $request->validate([
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $agenda->update(['status' => $request->status]);

        return back()->with('success', 'Status agenda berhasil diperbarui!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Agenda $agenda)
    {
        $agenda->update(['is_featured' => !$agenda->is_featured]);

        $message = $agenda->is_featured ? 'Agenda ditandai sebagai unggulan!' : 'Agenda dihapus dari unggulan!';
        
        return back()->with('success', $message);
    }
}
