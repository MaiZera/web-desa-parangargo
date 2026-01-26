<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'pangkat', 'golongan', 'pendidikan', 'telepon', 'email', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'mulai_menjabat', 'selesai_menjabat', 'urutan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('staff', 'public');
        }

        Staff::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, string $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'pangkat', 'golongan', 'pendidikan', 'telepon', 'email', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'mulai_menjabat', 'selesai_menjabat', 'urutan']);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($staff->foto) {
                Storage::disk('public')->delete($staff->foto);
            }
            $data['foto'] = $request->file('foto')->store('staff', 'public');
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);
        
        if ($staff->foto) {
            Storage::disk('public')->delete($staff->foto);
        }
        
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil dihapus.');
    }
}
