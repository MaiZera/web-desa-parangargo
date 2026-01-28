@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-start">
    <div class="space-y-8">
        <div class="space-y-4">
            <h1 class="text-4xl font-bold">Partisipasi Warga</h1>
            <p class="text-lg text-slate-600 leading-relaxed">Punya saran, keluhan, atau ide untuk desa kita? Jangan ragu untuk bersuara! Partisipasi Anda sangat berarti untuk kemajuan Desa Mandiri Jaya.</p>
        </div>
        
        <!-- <div class="space-y-6"> -->
            <!-- Privacy Card -->
            <!-- <div class="flex gap-4 items-start p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check w-6 h-6"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <div>
                   <h3 class="font-bold text-lg mb-1">Data Terjamin</h3>
                   <p class="text-slate-500 text-sm leading-relaxed">Identitas dan data pribadi Anda aman dan dilindungi undang-undang.</p>
                </div>
            </div> -->
             <!-- Speed Card -->
            <!-- <div class="flex gap-4 items-start p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="p-3 bg-orange-50 text-orange-600 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap w-6 h-6"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div>
                   <h3 class="font-bold text-lg mb-1">Respon Cepat</h3>
                   <p class="text-slate-500 text-sm leading-relaxed">Laporan Anda akan ditindaklanjuti oleh petugas dalam 2x24 jam kerja.</p>
                </div>
            </div> -->
             <!-- Help Card -->
            <!-- <div class="flex gap-4 items-start p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div>
                   <h3 class="font-bold text-lg mb-1">Musyawarah</h3>
                   <p class="text-slate-500 text-sm leading-relaxed">Setiap aspirasi akan dibahas dalam musyawarah rutin desa.</p>
                </div>
            </div>
        </div> -->
    </div>
    
    <form class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 space-y-6">
        <h3 class="text-2xl font-bold mb-4">Formulir Aspirasi</h3>
        <div class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Nama Lengkap</label>
                    <input required="" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Contoh: Budi Santoso" type="text" name="name">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">NIK (Sesuai KTP)</label>
                    <input required="" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500" placeholder="16 Digit Angka" type="text" name="nik">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Kategori Aspirasi</label>
                <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500" name="category">
                    <option>Saran Pembangunan</option>
                    <option>Keluhan Pelayanan</option>
                    <option>Laporan Keamanan</option>
                    <option>Lainnya</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Pesan Aspirasi</label>
                <textarea required="" rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500 resize-none" placeholder="Tuliskan detail masukan atau keluhan Anda di sini..." name="message"></textarea>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Unggah Foto Pendukung (Opsional)</label>
                <input class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" type="file" name="attachment">
            </div>
        </div>
        <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold hover:bg-emerald-700 transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/20">
            Kirim Aspirasi 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-4 h-4" aria-hidden="true"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path><path d="m21.854 2.147-10.94 10.939"></path></svg>
        </button>
    </form>
</div>
@endsection
