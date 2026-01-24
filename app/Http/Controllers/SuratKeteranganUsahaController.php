<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganUsaha;
use App\Models\User;
use Illuminate\Http\Request;

class SuratKeteranganUsahaController extends Controller
{
    /**
     * Display a listing of business certificate applications.
     */
    public function index(Request $request)
    {
        $query = SuratKeteranganUsaha::with('processor')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nomor_surat', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(15);

        return view('admin.surat-usaha.index', compact('applications'));
    }

    /**
     * Show the form for public submission (front-end).
     */
    public function create()
    {
        return view('public.surat-usaha.create');
    }

    /**
     * Store a newly submitted application (public).
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            // Applicant Information
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            
            // Business Information
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'tahun_mulai_usaha' => 'nullable|integer|min:1900|max:' . date('Y'),
            'modal_usaha' => 'nullable|numeric|min:0',
            'jumlah_karyawan' => 'nullable|integer|min:0',
            'keperluan' => 'required|string',
        ]);

        // Set default status
        $validated['status'] = 'pending';

        SuratKeteranganUsaha::create($validated);

        return redirect()->back()
            ->with('success', 'Permohonan surat keterangan usaha berhasil diajukan. Silakan tunggu proses verifikasi.');
    }

    /**
     * Display the specified application.
     */
    public function show(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $suratKeteranganUsaha->load('processor');
        
        return view('admin.surat-usaha.show', compact('suratKeteranganUsaha'));
    }

    /**
     * Show the form for processing application.
     */
    public function process(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        return view('admin.surat-usaha.process', compact('suratKeteranganUsaha'));
    }

    /**
     * Update application status to 'diproses'.
     */
    public function startProcessing(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $suratKeteranganUsaha->update([
            'status' => 'diproses',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Permohonan sedang diproses!');
    }

    /**
     * Approve the application.
     */
    public function approve(Request $request, SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_keterangan_usaha,nomor_surat,' . $suratKeteranganUsaha->id,
            'tanggal_surat' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $suratKeteranganUsaha->update([
            'status' => 'disetujui',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'catatan' => $request->catatan,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return redirect()->route('admin.surat-usaha.index')
            ->with('success', 'Permohonan disetujui! Surat siap dicetak.');
    }

    /**
     * Reject the application.
     */
    public function reject(Request $request, SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $suratKeteranganUsaha->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return redirect()->route('admin.surat-usaha.index')
            ->with('success', 'Permohonan ditolak.');
    }

    /**
     * Mark as completed.
     */
    public function complete(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $suratKeteranganUsaha->update(['status' => 'selesai']);

        return back()->with('success', 'Surat ditandai sebagai selesai!');
    }

    /**
     * Generate and download PDF.
     */
    public function print(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        if ($suratKeteranganUsaha->status !== 'disetujui' && $suratKeteranganUsaha->status !== 'selesai') {
            return back()->with('error', 'Surat belum disetujui!');
        }

        // TODO: Implement PDF generation using library like DomPDF or TCPDF
        // For now, return view for printing
        return view('admin.surat-usaha.print', compact('suratKeteranganUsaha'));
    }

    /**
     * Delete the application.
     */
    public function destroy(SuratKeteranganUsaha $suratKeteranganUsaha)
    {
        $suratKeteranganUsaha->delete();

        return redirect()->route('admin.surat-usaha.index')
            ->with('success', 'Permohonan berhasil dihapus!');
    }
}
