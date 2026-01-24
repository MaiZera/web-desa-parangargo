<?php

namespace App\Http\Controllers;

use App\Models\TransparansiPembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparansiPembangunanController extends Controller
{
    /**
     * Display a listing of transparansi pembangunan (Admin).
     */
    public function index(Request $request)
    {
        $query = TransparansiPembangunan::latest('created_at');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_pembangunan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('rt_number', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        // Filter by RT
        if ($request->filled('rt')) {
            $query->byRt($request->rt);
        }

        // Filter by RW
        if ($request->filled('rw')) {
            $query->byRw($request->rw);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by jenis pembangunan
        if ($request->filled('jenis')) {
            $query->where('jenis_pembangunan', $request->jenis);
        }

        $pembangunan = $query->paginate(15);

        // Get unique RT numbers for filter
        $rtNumbers = TransparansiPembangunan::select('rt_number')
            ->distinct()
            ->orderBy('rt_number')
            ->pluck('rt_number');

        // Get jenis pembangunan options
        $jenisPembangunan = $this->getJenisPembangunan();

        return view('admin.transparansi.index', compact('pembangunan', 'rtNumbers', 'jenisPembangunan'));
    }

    /**
     * Show the form for creating a new transparansi pembangunan.
     */
    public function create()
    {
        $jenisPembangunan = $this->getJenisPembangunan();
        $sumberDana = $this->getSumberDana();
        
        return view('admin.transparansi.create', compact('jenisPembangunan', 'sumberDana'));
    }

    /**
     * Store a newly created transparansi pembangunan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_pembangunan' => 'required|string|max:255',
            'rt_number' => 'required|string|max:10',
            'rw_number' => 'nullable|string|max:10',
            'lokasi' => 'required|string|max:255',
            'jenis_pembangunan' => 'required|string|max:255',
            'anggaran' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai_rencana' => 'required|date|after_or_equal:tanggal_mulai',
            'tanggal_selesai_aktual' => 'nullable|date',
            'status' => 'required|in:perencanaan,dalam_proses,selesai,ditunda',
            'persentase_penyelesaian' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle dokumentasi upload
        if ($request->hasFile('dokumentasi')) {
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('transparansi', 'public');
        }

        TransparansiPembangunan::create($validated);

        return redirect()->route('admin.transparansi.index')
            ->with('success', 'Data pembangunan berhasil ditambahkan!');
    }

    /**
     * Display the specified transparansi pembangunan.
     */
    public function show(TransparansiPembangunan $transparansi)
    {
        return view('admin.transparansi.show', compact('transparansi'));
    }

    /**
     * Show the form for editing the specified transparansi pembangunan.
     */
    public function edit(TransparansiPembangunan $transparansi)
    {
        $jenisPembangunan = $this->getJenisPembangunan();
        $sumberDana = $this->getSumberDana();
        
        return view('admin.transparansi.edit', compact('transparansi', 'jenisPembangunan', 'sumberDana'));
    }

    /**
     * Update the specified transparansi pembangunan.
     */
    public function update(Request $request, TransparansiPembangunan $transparansi)
    {
        $validated = $request->validate([
            'judul_pembangunan' => 'required|string|max:255',
            'rt_number' => 'required|string|max:10',
            'rw_number' => 'nullable|string|max:10',
            'lokasi' => 'required|string|max:255',
            'jenis_pembangunan' => 'required|string|max:255',
            'anggaran' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai_rencana' => 'required|date|after_or_equal:tanggal_mulai',
            'tanggal_selesai_aktual' => 'nullable|date',
            'status' => 'required|in:perencanaan,dalam_proses,selesai,ditunda',
            'persentase_penyelesaian' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable|string',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle dokumentasi upload
        if ($request->hasFile('dokumentasi')) {
            // Delete old dokumentasi
            if ($transparansi->dokumentasi) {
                Storage::disk('public')->delete($transparansi->dokumentasi);
            }
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('transparansi', 'public');
        }

        $transparansi->update($validated);

        return redirect()->route('admin.transparansi.index')
            ->with('success', 'Data pembangunan berhasil diperbarui!');
    }

    /**
     * Remove the specified transparansi pembangunan (soft delete).
     */
    public function destroy(TransparansiPembangunan $transparansi)
    {
        // Delete dokumentasi
        if ($transparansi->dokumentasi) {
            Storage::disk('public')->delete($transparansi->dokumentasi);
        }

        $transparansi->delete();

        return redirect()->route('admin.transparansi.index')
            ->with('success', 'Data pembangunan berhasil dihapus!');
    }

    /**
     * Display public transparansi page.
     */
    public function publicIndex(Request $request)
    {
        $query = TransparansiPembangunan::latest('tanggal_mulai');

        // Filter by RT
        if ($request->filled('rt')) {
            $query->byRt($request->rt);
        }

        // Filter by RW
        if ($request->filled('rw')) {
            $query->byRw($request->rw);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by jenis pembangunan
        if ($request->filled('jenis')) {
            $query->where('jenis_pembangunan', $request->jenis);
        }

        // Filter by year
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        $pembangunan = $query->paginate(10);

        // Get unique RT numbers for filter
        $rtNumbers = TransparansiPembangunan::select('rt_number')
            ->distinct()
            ->orderBy('rt_number')
            ->pluck('rt_number');

        // Get unique years for filter
        $years = TransparansiPembangunan::selectRaw('YEAR(tanggal_mulai) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // Get jenis pembangunan options
        $jenisPembangunan = $this->getJenisPembangunan();

        // Statistics
        $stats = [
            'total' => TransparansiPembangunan::count(),
            'selesai' => TransparansiPembangunan::selesai()->count(),
            'dalam_proses' => TransparansiPembangunan::where('status', 'dalam_proses')->count(),
            'perencanaan' => TransparansiPembangunan::where('status', 'perencanaan')->count(),
            'total_anggaran' => TransparansiPembangunan::sum('anggaran'),
        ];

        return view('transparansi.index', compact('pembangunan', 'rtNumbers', 'jenisPembangunan', 'years', 'stats'));
    }

    /**
     * Get jenis pembangunan options.
     */
    private function getJenisPembangunan()
    {
        return [
            'Infrastruktur Jalan',
            'Saluran Air/Drainase',
            'Jembatan',
            'Fasilitas Umum',
            'Sarana Ibadah',
            'Sarana Pendidikan',
            'Sarana Kesehatan',
            'Sarana Olahraga',
            'Taman/RTH',
            'Penerangan Jalan',
            'Sanitasi',
            'Air Bersih',
            'Lainnya',
        ];
    }

    /**
     * Get sumber dana options.
     */
    private function getSumberDana()
    {
        return [
            'APBD Kabupaten',
            'APBD Provinsi',
            'APBN',
            'Dana Desa',
            'Swadaya Masyarakat',
            'CSR',
            'Hibah',
            'Gabungan',
            'Lainnya',
        ];
    }

    /**
     * Update status pembangunan.
     */
    public function updateStatus(Request $request, TransparansiPembangunan $transparansi)
    {
        $validated = $request->validate([
            'status' => 'required|in:perencanaan,dalam_proses,selesai,ditunda',
            'persentase_penyelesaian' => 'required|integer|min:0|max:100',
        ]);

        $transparansi->update($validated);

        return back()->with('success', 'Status pembangunan berhasil diperbarui!');
    }
}
