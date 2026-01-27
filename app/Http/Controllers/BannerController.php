<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->latest()
            ->paginate(9); // Adjust pagination as needed

        return view('pages.banner.index', compact('banners'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        // Ensure only active banners can be viewed via public route if restricted
        if (!$banner->is_active) {
            abort(404);
        }

        return view('pages.banner.show', compact('banner'));
    }
}
