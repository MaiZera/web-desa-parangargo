<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index(Request $request)
    {
        $query = Announcement::with('author')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $announcements = $query->paginate(15);

        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created announcement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:urgent,penting,umum',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'icon' => 'nullable|string|max:255',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle file upload
        if ($request->hasFile('file_lampiran')) {
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('announcements', 'public');
        }

        // Set author
        $validated['author_id'] = auth()->id();

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat!');
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('author');
        
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified announcement.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:urgent,penting,umum',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'icon' => 'nullable|string|max:255',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle file upload
        if ($request->hasFile('file_lampiran')) {
            // Delete old file
            if ($announcement->file_lampiran) {
                Storage::disk('public')->delete($announcement->file_lampiran);
            }
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified announcement (soft delete).
     */
    public function destroy(Announcement $announcement)
    {
        // Delete file
        if ($announcement->file_lampiran) {
            Storage::disk('public')->delete($announcement->file_lampiran);
        }

        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    /**
     * Publish an announcement.
     */
    public function publish(Announcement $announcement)
    {
        $announcement->update(['status' => 'published']);

        return back()->with('success', 'Pengumuman berhasil dipublikasikan!');
    }

    /**
     * Unpublish an announcement.
     */
    public function unpublish(Announcement $announcement)
    {
        $announcement->update(['status' => 'draft']);

        return back()->with('success', 'Pengumuman berhasil di-unpublish!');
    }

    /**
     * Archive an announcement.
     */
    public function archive(Announcement $announcement)
    {
        $announcement->update(['status' => 'archived']);

        return back()->with('success', 'Pengumuman berhasil diarsipkan!');
    }
}
