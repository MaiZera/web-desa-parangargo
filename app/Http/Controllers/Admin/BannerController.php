<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            
            Banner::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
