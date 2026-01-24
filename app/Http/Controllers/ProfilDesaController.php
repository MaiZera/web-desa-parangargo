<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    /**
     * Display the village profile (view only, single record).
     */
    public function index()
    {
        $profil = ProfilDesa::first();
        
        if (!$profil) {
            // Create default profile if not exists
            $profil = ProfilDesa::create([
                'nama_desa' => 'Nama Desa',
                'alamat' => 'Alamat Lengkap Desa',
                'kecamatan' => 'Nama Kecamatan',
                'kabupaten' => 'Nama Kabupaten',
                'provinsi' => 'Nama Provinsi',
            ]);
        }
        
        return view('admin.profil-desa.index', compact('profil'));
    }

    /**
     * Show the form for editing the village profile.
     */
    public function edit()
    {
        $profil = ProfilDesa::first();
        
        return view('admin.profil-desa.edit', compact('profil'));
    }

    /**
     * Update the village profile.
     */
    public function update(Request $request)
    {
        $profil = ProfilDesa::first();

        $validated = $request->validate([
            // Basic Information
            'nama_desa' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            
            // Vision & Mission
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            
            // Geographic Data
            'luas_wilayah' => 'nullable|numeric',
            'batas_utara' => 'nullable|string|max:255',
            'batas_selatan' => 'nullable|string|max:255',
            'batas_timur' => 'nullable|string|max:255',
            'batas_barat' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'ketinggian' => 'nullable|integer',
            
            // Demographic Data
            'jumlah_penduduk' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'jumlah_laki_laki' => 'nullable|integer',
            'jumlah_perempuan' => 'nullable|integer',
            'jumlah_dusun' => 'nullable|integer',
            'jumlah_rw' => 'nullable|integer',
            'jumlah_rt' => 'nullable|integer',
            
            // Media
            'logo' => 'nullable|image|mimes:png,jpg,svg|max:2048',
            'gambar_kantor' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_peta' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $validated['logo'] = $request->file('logo')->store('profil', 'public');
        }

        // Handle office photo upload
        if ($request->hasFile('gambar_kantor')) {
            if ($profil->gambar_kantor) {
                Storage::disk('public')->delete($profil->gambar_kantor);
            }
            $validated['gambar_kantor'] = $request->file('gambar_kantor')->store('profil', 'public');
        }

        // Handle map photo upload
        if ($request->hasFile('gambar_peta')) {
            if ($profil->gambar_peta) {
                Storage::disk('public')->delete($profil->gambar_peta);
            }
            $validated['gambar_peta'] = $request->file('gambar_peta')->store('profil', 'public');
        }

        $profil->update($validated);

        return redirect()->route('admin.profil-desa.index')
            ->with('success', 'Profil desa berhasil diperbarui!');
    }
}
