<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transparency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparencyController extends Controller
{
    public function index()
    {
        $transparencies = Transparency::latest()->get();
        return view('admin.transparency.index', compact('transparencies'));
    }

    public function create()
    {
        return view('admin.transparency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'title.required' => 'Judul banner wajib diisi.',
            'image.required' => 'Gambar banner wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
            'image.uploaded' => 'Gagal mengupload gambar.',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('transparency', 'public');

            Transparency::create([
                'title' => $request->title,
                'image' => $path,
            ]);

            return redirect()->route('admin.transparency.index')->with('success', 'Banner APBD berhasil ditambahkan.');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    public function destroy(Transparency $transparency)
    {
        if ($transparency->image) {
            Storage::disk('public')->delete($transparency->image);
        }

        $transparency->delete();

        return redirect()->route('admin.transparency.index')->with('success', 'Banner berhasil dihapus.');
    }
}
