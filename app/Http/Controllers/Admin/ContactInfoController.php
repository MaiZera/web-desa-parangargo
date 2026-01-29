<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileDesa;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $profile = ProfileDesa::firstOrCreate([]);
        return view('admin.contact-info.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'alamat' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'youtube' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'jam_kerja_senin_kamis' => 'nullable|string',
            'jam_kerja_jumat' => 'nullable|string',
            'jam_kerja_sabtu_minggu' => 'nullable|string',
        ]);

        $profile = ProfileDesa::firstOrCreate([]);

        $profile->update($request->only([
            'telepon',
            'email',
            'alamat',
            'facebook',
            'instagram',
            'twitter',
            'youtube',
            'tiktok',
            'jam_kerja_senin_kamis',
            'jam_kerja_jumat',
            'jam_kerja_sabtu_minggu'
        ]));

        return redirect()->route('admin.contact-info.edit')->with('success', 'Informasi Kontak Desa berhasil diupdate.');
    }
}
