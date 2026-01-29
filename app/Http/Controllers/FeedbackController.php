<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback.
     */
    public function index(Request $request)
    {
        $query = Feedback::with('responder')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subjek', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$request->month]);
        }

        $feedback = $query->paginate(15);

        // Get available months for filter
        $months = Feedback::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as value, DATE_FORMAT(created_at, '%M %Y') as label")
            ->distinct()
            ->orderBy('value', 'desc')
            ->get();

        return view('admin.feedback.index', compact('feedback', 'months'));
    }

    /**
     * Show the form for public feedback submission.
     */
    public function create()
    {
        return view('public.feedback.create');
    }

    /**
     * Store a newly submitted feedback (public).
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            // 'email' => 'nullable|email|max:255', // Removed
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'nullable|in:Saran Pembangunan,Keluhan Pelayanan,Laporan Keamanan,Lainnya',
            'lampiran' => 'nullable|image|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'deskripsi.required' => 'Pesan aspirasi wajib diisi.',
            'lampiran.image' => 'File harus berupa gambar.',
            'lampiran.max' => 'Ukuran file foto maksimal 2MB.',
        ]);

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('feedback', 'public');
            $validated['lampiran'] = $path;
        }

        // Set default status
        $validated['status'] = 'baru';

        Feedback::create($validated);

        return redirect()->back()
            ->with('success', 'Terima kasih atas masukan Anda. Kami akan segera menindaklanjuti.');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        $feedback->load('responder');

        // Mark as read
        if ($feedback->status === 'baru') {
            $feedback->update(['status' => 'dibaca']);
        }

        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for responding to feedback.
     */
    public function respond(Feedback $feedback)
    {
        return view('admin.feedback.respond', compact('feedback'));
    }

    /**
     * Store the response to feedback.
     */
    public function storeResponse(Request $request, Feedback $feedback)
    {
        $request->validate([
            'tanggapan' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $feedback->update([
            'tanggapan' => $request->tanggapan,
            'responder_id' => auth()->id(),
            'responded_at' => now(),
            'status' => 'diproses',
            'rating' => $request->rating,
        ]);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Tanggapan berhasil dikirim!');
    }

    /**
     * Mark feedback as completed.
     */
    public function complete(Feedback $feedback)
    {
        $feedback->update(['status' => 'selesai']);

        return back()->with('success', 'Feedback ditandai sebagai selesai!');
    }

    /**
     * Update feedback status.
     */
    public function updateStatus(Request $request, Feedback $feedback)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,diproses,selesai',
        ]);

        $feedback->update(['status' => $request->status]);

        return back()->with('success', 'Status feedback berhasil diperbarui!');
    }

    /**
     * Delete the feedback.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil dihapus!');
    }
}
