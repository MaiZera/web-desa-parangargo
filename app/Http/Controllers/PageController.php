<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\ProfileDesa;

class PageController extends Controller
{
    public function about()
    {
        $staff = Staff::where('is_active', true)->orderBy('urutan')->get();
        $profile = ProfileDesa::first();
        return view('pages.about', compact('staff', 'profile'));
    }

    public function services()
    {
        return view('pages.services');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function artikel()
    {
        return view('pages.artikel');
    }

    public function pengumuman()
    {
        return view('pages.pengumuman');
    }

    public function announcementDetail($slug)
    {
        return view('pages.announcement-detail');
    }

    public function laporan()
    {
        return view('pages.laporan');
    }

    public function newsDetail($slug)
    {
        return view('pages.news-detail');
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

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function profileDesa()
    {
        return view('pages.profile-desa');
    }

    public function demografis()
    {
        return view('pages.demografis');
    }

    public function strukturDesa()
    {
        $staff = Staff::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.struktur-desa', compact('staff'));
    }

    public function maps()
    {
        return view('pages.maps');
    }
}
