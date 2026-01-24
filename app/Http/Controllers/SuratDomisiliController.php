<?php

namespace App\Http\Controllers;

use App\Models\SuratDomisili;
use App\Models\User;
use Illuminate\Http\Request;

class SuratDomisiliController extends Controller
{
    /**
     * Display a listing of domicile letter applications.
     */
    public function index(Request $request)
    {
        $query = SuratDomisili::with('processor')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('nomor_surat', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(15);

        return view('admin.surat-domisili.index', compact('applications'));
    }

    /**
     * Show the form for public submission (front-end).
     */
    public function create()
    {
        return view('public.surat-domisili.create');
    }

    /**
     * Store a newly submitted application (public).
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'keperluan' => 'required|string',
        ]);

        // Set default status
        $validated['status'] = 'pending';

        SuratDomisili::create($validated);

        return redirect()->back()
            ->with('success', 'Permohonan surat domisili berhasil diajukan. Silakan tunggu proses verifikasi.');
    }

    /**
     * Display the specified application.
     */
    public function show(SuratDomisili $suratDomisili)
    {
        $suratDomisili->load('processor');
        
        return view('admin.surat-domisili.show', compact('suratDomisili'));
    }

    /**
     * Show the form for processing application.
     */
    public function process(SuratDomisili $suratDomisili)
    {
        return view('admin.surat-domisili.process', compact('suratDomisili'));
    }

    /**
     * Update application status to 'diproses'.
     */
    public function startProcessing(SuratDomisili $suratDomisili)
    {
        $suratDomisili->update([
            'status' => 'diproses',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Permohonan sedang diproses!');
    }

    /**
     * Approve the application.
     */
    public function approve(Request $request, SuratDomisili $suratDomisili)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_domisili,nomor_surat,' . $suratDomisili->id,
            'tanggal_surat' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $suratDomisili->update([
            'status' => 'disetujui',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'catatan' => $request->catatan,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return redirect()->route('admin.surat-domisili.index')
            ->with('success', 'Permohonan disetujui! Surat siap dicetak.');
    }

    /**
     * Reject the application.
     */
    public function reject(Request $request, SuratDomisili $suratDomisili)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $suratDomisili->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return redirect()->route('admin.surat-domisili.index')
            ->with('success', 'Permohonan ditolak.');
    }

    /**
     * Mark as completed.
     */
    public function complete(SuratDomisili $suratDomisili)
    {
        $suratDomisili->update(['status' => 'selesai']);

        return back()->with('success', 'Surat ditandai sebagai selesai!');
    }

    /**
     * Generate and download PDF.
     */
    public function print(SuratDomisili $suratDomisili)
    {
        if ($suratDomisili->status !== 'disetujui' && $suratDomisili->status !== 'selesai') {
            return back()->with('error', 'Surat belum disetujui!');
        }

        // TODO: Implement PDF generation using library like DomPDF or TCPDF
        // For now, return view for printing
        return view('admin.surat-domisili.print', compact('suratDomisili'));
    }

    /**
     * Delete the application.
     */
    public function destroy(SuratDomisili $suratDomisili)
    {
        $suratDomisili->delete();

        return redirect()->route('admin.surat-domisili.index')
            ->with('success', 'Permohonan berhasil dihapus!');
    }
}
