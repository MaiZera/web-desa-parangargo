@extends('layouts.main')

@section('content')
<style>
    /* Style for lists in prose content */
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5rem;
    }
    
    .prose ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
    }
    
    .prose li {
        margin-bottom: 0.25rem;
    }
</style>

<div class="space-y-16 py-12 px-4 max-w-7xl mx-auto">
    <section class="grid lg:grid-cols-3 md:grid-cols-2 gap-12 items-start">
        <div class="space-y-12 lg:col-span-2">
            <!-- Profil & Sejarah -->
            <div class="space-y-6">
                <h1 class="text-4xl font-bold text-slate-900">Profil & Sejarah Desa</h1>
                
                @if($profile && $profile->deskripsi)
                    <div class="text-lg text-slate-600 leading-relaxed prose prose-slate max-w-none">
                        {!! $profile->deskripsi !!}
                    </div>
                @else
                    <p class="text-lg text-slate-600 leading-relaxed">Desa Parangargo didirikan pada tahun 1945 oleh sekelompok pejuang kemerdekaan yang ingin membangun pemukiman mandiri yang berlandaskan gotong royong. Berlokasi di kaki pegunungan, desa ini awalnya merupakan sentra pertanian yang kini berkembang menjadi desa digital percontohan.</p>
                @endif
            </div>

            <!-- Visi & Misi -->
            <div class="space-y-6">
                <!-- <h2 class="text-3xl font-bold text-slate-900">Visi & Misi</h2> -->
                
                    <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <h3 class="font-bold text-emerald-600 mb-2">Visi</h3>
                        @if($profile && $profile->visi)
                            <div class="text-sm text-slate-600 prose prose-sm max-w-none">
                                {!! $profile->visi !!}
                            </div>
                        @else
                            <p class="text-sm text-slate-500">Mewujudkan desa yang mandiri, cerdas, dan sejahtera lahir batin.</p>
                        @endif
                    </div>
                    <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                        <h3 class="font-bold text-emerald-600 mb-2">Misi</h3>
                        @if($profile && $profile->misi)
                            <div class="text-sm text-slate-600 prose prose-sm max-w-none">
                                {!! $profile->misi !!}
                            </div>
                        @else
                            <ul class="text-sm text-slate-600 list-disc list-inside space-y-1">
                                <li>Meningkatkan layanan digital</li>
                                <li>Memberdayakan UMKM lokal</li>
                                <li>Pelestarian lingkungan hidup</li>
                            </ul>
                        @endif
                    </div>
            </div>
        </div>

        <div class="sticky top-8 h-fit rounded-3xl overflow-hidden shadow-2xl rotate-2">
            @if($profile && $profile->image_path)
                <img alt="Profil Desa" class="w-full h-auto object-cover" src="{{ asset('storage/' . $profile->image_path) }}">
            @else
                <img alt="Sejarah Desa" class="w-full h-auto object-cover" src="https://picsum.photos/seed/history/800/1000">
            @endif
        </div>
    </section>

    <!-- Data Demografis Section -->
    <section class="space-y-12">
        <div class="text-center">
            <h2 class="text-3xl font-bold">Data Demografis</h2>
            <p class="text-slate-500">Gambaran nyata penduduk Desa Parangargo</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Gender -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Keseimbangan Gender</h3>
                <div class="flex-1 flex flex-col items-center justify-center bg-slate-50 rounded-2xl relative overflow-hidden p-6">
                    <div class="w-32 h-32 rounded-full border-[16px] border-blue-500 border-r-pink-500 rotate-45 mb-6 shadow-inner"></div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="text-center">
                            <p class="text-2xl font-black text-blue-500">48%</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Laki-laki</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-pink-500">52%</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Tingkat Pendidikan</h3>
                <div class="flex-1 flex flex-col justify-end bg-slate-50 rounded-2xl p-6 gap-3">
                    <div class="flex items-end gap-2 h-32">
                        <div class="flex-1 bg-emerald-100 rounded-lg transition-all hover:bg-emerald-500 h-[40%] group relative">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold text-emerald-600">SD</div>
                        </div>
                        <div class="flex-1 bg-emerald-200 rounded-lg transition-all hover:bg-emerald-500 h-[60%] group relative">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold text-emerald-600">SMP</div>
                        </div>
                        <div class="flex-1 bg-emerald-400 rounded-lg transition-all hover:bg-emerald-500 h-[85%] group relative">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold text-emerald-600">SMA</div>
                        </div>
                        <div class="flex-1 bg-emerald-600 rounded-lg transition-all h-[55%] group relative">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold text-emerald-600">PT</div>
                        </div>
                    </div>
                    <p class="text-[9px] text-center font-bold text-slate-400 uppercase mt-2">Didominasi Lulusan SMA/SMK</p>
                </div>
            </div>

            <!-- Religion (NEW) -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Proporsi Agama</h3>
                <div class="flex-1 flex flex-col gap-4 bg-slate-50 rounded-2xl p-6 overflow-y-auto custom-scrollbar">
                    <div class="space-y-1">
                        <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">Islam</span> <span class="text-emerald-600">92%</span></div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-emerald-500 h-full w-[92%]"></div></div>
                    </div>
                    <div class="space-y-1">
                        <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">Kristen</span> <span class="text-blue-600">5%</span></div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-blue-500 h-full w-[5%]"></div></div>
                    </div>
                    <div class="space-y-1">
                        <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">Hindu</span> <span class="text-amber-600">2%</span></div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-amber-500 h-full w-[2%]"></div></div>
                    </div>
                    <div class="space-y-1">
                        <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">Lainnya</span> <span class="text-slate-400">1%</span></div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-slate-400 h-full w-[1%]"></div></div>
                    </div>
                </div>
            </div>

            <!-- Occupation (NEW) -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Mata Pencaharian</h3>
                <div class="flex-1 flex flex-col justify-center bg-slate-50 rounded-2xl p-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-10 bg-emerald-500 rounded-full"></div>
                            <div>
                                <p class="text-xl font-black text-slate-900 leading-none">Petani</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Sektor Utama (64%)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-10 bg-blue-500 rounded-full"></div>
                            <div>
                                <p class="text-xl font-black text-slate-900 leading-none">Wirausaha</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Pedagang & UMKM (22%)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-10 bg-slate-400 rounded-full"></div>
                            <div>
                                <p class="text-xl font-black text-slate-900 leading-none">Pegawai</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">PNS/Karyawan (14%)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold">Struktur Organisasi</h2>
            <p class="text-slate-500">Pelayan masyarakat Desa Parangargo</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @forelse($staff as $member)
                <!-- Staff Member -->
                <div class="text-center group">
                    <div class="relative mb-4 inline-block">
                        <div class="absolute inset-0 bg-emerald-600 rounded-2xl rotate-6 group-hover:rotate-0 transition-transform"></div>
                        @if($member->foto)
                            <img alt="{{ $member->nama }}" class="relative w-40 h-40 object-cover rounded-2xl shadow-lg border-2 border-white" src="{{ asset('storage/' . $member->foto) }}">
                        @else
                            <div class="relative w-40 h-40 bg-gray-200 rounded-2xl shadow-lg border-2 border-white flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-bold text-lg">{{ $member->nama }}</h3>
                    <p class="text-emerald-600 font-medium text-sm">{{ $member->jabatan }}</p>
                    @if($member->nip)
                        <p class="text-xs text-gray-400 mt-1">NIP: {{ $member->nip }}</p>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>Data staff belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="bg-slate-900 text-white rounded-[3rem] p-12 overflow-hidden relative">
        <div class="grid md:grid-cols-2 gap-12 relative z-10">
            <div class="space-y-8">
                <h2 class="text-3xl font-bold">Hubungi &amp; Kunjungi Kami</h2>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-white/10 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-6 h-6 text-emerald-400"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                        <div>
                            <p class="text-emerald-400 font-bold text-sm">Alamat Kantor</p>
                            <p class="text-slate-300">Jl. Raya Parangargo No. 1, Desa Parangargo, Kec. Wagir, Kab. Malang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-full min-h-[300px] rounded-3xl overflow-hidden grayscale contrast-125 brightness-75">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15801.439268383827!2d112.58614486518428!3d-8.03444654924769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7882956f4d221d%3A0xc348633c7f96bbf0!2sParangargo%2C%20Wagir%2C%20Malang%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1706423000000!5m2!1sen!2sid" width="100%" height="100%" style="border: 0px;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
</div>
@endsection
