<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function transparency()
    {
        return view('pages.transparency');
    }

    public function umkm()
    {
        return view('pages.umkm');
    }

    public function participation()
    {
        return view('pages.participation');
    }
}
