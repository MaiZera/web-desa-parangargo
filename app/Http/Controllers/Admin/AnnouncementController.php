<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Announcement::with('author')->latest();

        // Search
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $announcements = $query->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a new resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'tipe' => 'required|in:umum,agenda,layanan,darurat,berita',
            'status' => 'required|in:draft,published,archived',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->except('file_lampiran');
        $data['author_id'] = auth()->id();

        // Dates only apply if type is agenda
        if ($data['tipe'] !== 'agenda') {
            $data['tanggal_mulai'] = null;
            $data['tanggal_selesai'] = null;
        }

        if ($request->hasFile('file_lampiran')) {
            $data['file_lampiran'] = $request->file('file_lampiran')->store('announcements', 'public');
        }

        Announcement::create($data);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'tipe' => 'required|in:umum,agenda,layanan,darurat,berita',
            'status' => 'required|in:draft,published,archived',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->except('file_lampiran');

        // Dates only apply if type is agenda
        if ($data['tipe'] !== 'agenda') {
            $data['tanggal_mulai'] = null;
            $data['tanggal_selesai'] = null;
        }

        if ($request->hasFile('file_lampiran')) {
            if ($announcement->file_lampiran) {
                Storage::disk('public')->delete($announcement->file_lampiran);
            }
            $data['file_lampiran'] = $request->file('file_lampiran')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->file_lampiran) {
            Storage::disk('public')->delete($announcement->file_lampiran);
        }

        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
