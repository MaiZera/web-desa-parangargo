<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        // For debugging, let's verify if view exists or fallback to welcome
        $banners = Banner::where('is_active', true)->latest()->get();
        
        if (view()->exists('pages.home')) {
            return view('pages.home', compact('banners'));
        }
        return view('welcome', compact('banners'));
    }
}
