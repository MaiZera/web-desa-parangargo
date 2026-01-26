<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demografis;
use Illuminate\Http\Request;

class DemografisController extends Controller
{
    public function edit()
    {
        $demografis = Demografis::firstOrCreate([]);
        return view('admin.demografis.edit', compact('demografis'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jumlah_penduduk' => 'nullable|integer',
            'kepadatan' => 'nullable|string',
            'struktur_umur' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'tingkat_pendidikan' => 'nullable|string',
            'mata_pencaharian' => 'nullable|string',
            'agama' => 'nullable|string',
        ]);

        $demografis = Demografis::firstOrCreate([]);
        $demografis->update($request->all());

        return redirect()->route('admin.demografis.edit')->with('success', 'Data Demografis berhasil diupdate.');
    }
}
