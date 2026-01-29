<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of village staff.
     */
    public function index(Request $request)
    {
        $query = Staff::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Order by urutan (display order)
        $staff = $query->orderBy('urutan')->paginate(15);

        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        $maxUrutan = Staff::max('urutan') ?? 0;
        
        return view('admin.staff.create', compact('maxUrutan'));
    }

    /**
     * Store a newly created staff.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'mulai_menjabat' => 'nullable|date',
            'selesai_menjabat' => 'nullable|date|after:mulai_menjabat',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        Staff::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data perangkat desa berhasil ditambahkan!');
    }

    /**
     * Display the specified staff.
     */
    public function show(Staff $staff)
    {
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'mulai_menjabat' => 'nullable|date',
            'selesai_menjabat' => 'nullable|date|after:mulai_menjabat',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($staff->foto) {
                Storage::disk('public')->delete($staff->foto);
            }
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data perangkat desa berhasil diperbarui!');
    }

    /**
     * Remove the specified staff.
     */
    public function destroy(Staff $staff)
    {
        // Delete photo
        if ($staff->foto) {
            Storage::disk('public')->delete($staff->foto);
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data perangkat desa berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Staff $staff)
    {
        $staff->update(['is_active' => !$staff->is_active]);

        $message = $staff->is_active ? 'Perangkat diaktifkan!' : 'Perangkat dinonaktifkan!';
        
        return back()->with('success', $message);
    }

    /**
     * Reorder staff.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:staff,id',
            'orders.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            Staff::where('id', $order['id'])->update(['urutan' => $order['urutan']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui!']);
    }
}
