<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::active();

        if ($request->has('kategori') && $request->kategori !== 'Semua') {
            $query->byKategori($request->kategori);
        }

        if ($request->has('search')) {
            $query->where('nama_usaha', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $umkms = $query->orderBy('nama_usaha', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $umkms->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_usaha' => $item->nama_usaha,
                    'nama_pemilik' => $item->nama_pemilik,
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->deskripsi,
                    'produk_layanan' => $item->produk_layanan,
                    'alamat' => $item->alamat,
                    'telepon' => $item->telepon,
                    'whatsapp' => $item->whatsapp,
                    'instagram' => $item->instagram,
                    'facebook' => $item->facebook,
                    'website' => $item->website,
                    'logo' => $item->logo ? asset('storage/' . $item->logo) : null,
                    'foto_produk' => $item->foto_produk ? asset('storage/' . $item->foto_produk) : 'https://picsum.photos/seed/' . $item->id . '/600/400',
                    'kisaran_harga' => $item->kisaran_harga,
                ];
            })
        ]);
    }

    public function show(Umkm $umkm)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $umkm->id,
                'nama_usaha' => $umkm->nama_usaha,
                'nama_pemilik' => $umkm->nama_pemilik,
                'kategori' => $umkm->kategori,
                'deskripsi' => $umkm->deskripsi,
                'produk_layanan' => $umkm->produk_layanan,
                'alamat' => $umkm->alamat,
                'telepon' => $umkm->telepon,
                'whatsapp' => $umkm->whatsapp,
                'instagram' => $umkm->instagram,
                'facebook' => $umkm->facebook,
                'website' => $umkm->website,
                'foto_produk' => $umkm->foto_produk ? asset('storage/' . $umkm->foto_produk) : 'https://picsum.photos/seed/' . $umkm->id . '/600/400',
                'kisaran_harga' => $umkm->kisaran_harga,
            ]
        ]);
    }
}
