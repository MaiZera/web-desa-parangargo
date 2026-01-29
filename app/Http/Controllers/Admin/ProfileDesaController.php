<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileDesaController extends Controller
{
    public function edit()
    {
        // Get the first (and only) profile record, or create if doesn't exist
        $profile = ProfileDesa::firstOrCreate([]);
        return view('admin.profile-desa.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $profile = ProfileDesa::firstOrCreate([]);

        $data = $request->except(['image', '_token', '_method']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($profile->image_path) {
                Storage::disk('public')->delete($profile->image_path);
            }
            $data['image_path'] = $request->file('image')->store('profile-desa', 'public');
        }

        $profile->update($data);

        return redirect()->route('admin.profile-desa.edit')->with('success', 'Profile Desa berhasil diupdate.');
    }
}
