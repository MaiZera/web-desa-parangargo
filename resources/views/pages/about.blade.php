@php
    // SEO Variables for page About
    $seoTitle = 'Tentang Desa Parangargo - Profil, Sejarah, dan Demografis';
    $seoDescription = 'Profil lengkap Desa Parangargo, Kabupaten Malang termasuk sejarah, visi misi, data demografis, struktur organisasi pemerintahan desa, dan informasi geografis wilayah.';
    $seoKeywords = 'profil desa parangargo, sejarah parangargo, demografis parangargo, struktur organisasi desa, pemerintah desa parangargo,  kabupaten malang, wagir malang';
    $seoImage = $profile && $profile->image_path ? asset('storage/' . $profile->image_path) : asset('images/logo.png');
@endphp

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
                        <p class="text-lg text-slate-600 leading-relaxed">Data deskripsi desa belum tersedia.</p>
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
                                <p class="text-sm text-slate-500">Data visi belum tersedia.</p>
                            @endif
                        </div>
                        <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                            <h3 class="font-bold text-emerald-600 mb-2">Misi</h3>
                            @if($profile && $profile->misi)
                                <div class="text-sm text-slate-600 prose prose-sm max-w-none">
                                    {!! $profile->misi !!}
                                </div>
                            @else
                                <p class="text-sm text-slate-500">Data misi belum tersedia.</p>
                            @endif
                        </div>
                </div>
            </div>

            <div class="sticky top-8 h-fit rounded-3xl overflow-hidden shadow-2xl rotate-2">
                @if($profile && $profile->image_path)
                    <img alt="Profil Desa" class="w-full h-auto object-cover" src="{{ asset('storage/' . $profile->image_path) }}">
                @else
                    <img alt="Profil Desa Default" class="w-full h-auto object-cover" src="https://placehold.co/800x1000/e2e8f0/64748b?text=Profil+Desa">
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
            @php
                $penduduk = $demografis->jumlah_penduduk ?? 0;
                $laki = $demografis->jumlah_laki_laki ?? 0;
                $perempuan = $demografis->jumlah_perempuan ?? 0;
                $persenLaki = $penduduk > 0 ? round(($laki / $penduduk) * 100) : 0;
                $persenPerempuan = $penduduk > 0 ? round(($perempuan / $penduduk) * 100) : 0;
            @endphp
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Perbandingan</h3>
                <div class="flex-1 flex flex-col items-center justify-center bg-slate-50 rounded-2xl relative overflow-hidden p-6">
                    <!-- Dynamic Donut Chart using Conic Gradient -->
                    <div class="w-32 h-32 rounded-full relative shadow-inner mb-6"
                         style="background: conic-gradient(#3b82f6 {{ $persenLaki }}%, #ec4899 {{ $persenLaki }}% 100%);">
                         <!-- Inner circle to create donut effect -->
                         <div class="absolute inset-4 bg-slate-50 rounded-full"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="text-center">
                            <p class="text-2xl font-black text-blue-500">{{ $persenLaki }}%</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Laki-laki ({{ number_format($laki) }})</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-pink-500">{{ $persenPerempuan }}%</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Perempuan ({{ number_format($perempuan) }})</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            @php
                $edu = $demografis->tingkat_pendidikan ?? [];
                $eduMode = $edu['mode'] ?? 'percentage'; // percentage or number
                // Default values if empty
                $sd = $edu['sd'] ?? 0;
                $smp = $edu['smp'] ?? 0;
                $sma = $edu['sma'] ?? 0;
                $pt = $edu['pt'] ?? 0;

                // Calculate max value for bar height normalization
                $maxEdu = max($sd, $smp, $sma, $pt);
                $maxEdu = $maxEdu == 0 ? 1 : $maxEdu; // Prevent division by zero

                // Calculate heights (min 10% for visibility)
                $hSD = max(10, round(($sd / $maxEdu) * 100));
                $hSMP = max(10, round(($smp / $maxEdu) * 100));
                $hSMA = max(10, round(($sma / $maxEdu) * 100));
                $hPT = max(10, round(($pt / $maxEdu) * 100));
            @endphp
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Tingkat Pendidikan</h3>
                <div class="flex-1 flex flex-col justify-end bg-slate-50 rounded-2xl p-6 gap-3">
                    <div class="flex items-end gap-2 h-32">
                        <div class="flex-1 bg-emerald-100 rounded-lg transition-all hover:bg-emerald-500 group relative" 
                             style="height: {{ $hSD }}%" 
                             title="SD: {{ $sd }}">
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 flex flex-col items-center min-w-[max-content] transition-opacity duration-200 z-10 pointer-events-none">
                                <span class="text-[10px] font-bold text-emerald-600 group-hover:text-emerald-700">SD</span>
                                <span class="text-xs font-black text-slate-800 bg-white px-2 py-0.5 rounded shadow-sm">{{ $eduMode == 'percentage' ? $sd . '%' : number_format($sd) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-emerald-200 rounded-lg transition-all hover:bg-emerald-500 group relative" 
                             style="height: {{ $hSMP }}%" 
                             title="SMP: {{ $smp }}">
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 flex flex-col items-center min-w-[max-content] transition-opacity duration-200 z-10 pointer-events-none">
                                <span class="text-[10px] font-bold text-emerald-600 group-hover:text-emerald-700">SMP</span>
                                <span class="text-xs font-black text-slate-800 bg-white px-2 py-0.5 rounded shadow-sm">{{ $eduMode == 'percentage' ? $smp . '%' : number_format($smp) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-emerald-400 rounded-lg transition-all hover:bg-emerald-500 group relative" 
                             style="height: {{ $hSMA }}%" 
                             title="SMA: {{ $sma }}">
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 flex flex-col items-center min-w-[max-content] transition-opacity duration-200 z-10 pointer-events-none">
                                <span class="text-[10px] font-bold text-emerald-600 group-hover:text-emerald-700">SMA</span>
                                <span class="text-xs font-black text-slate-800 bg-white px-2 py-0.5 rounded shadow-sm">{{ $eduMode == 'percentage' ? $sma . '%' : number_format($sma) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-emerald-600 rounded-lg transition-all hover:bg-emerald-500 group relative" 
                             style="height: {{ $hPT }}%" 
                             title="PT: {{ $pt }}">
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 flex flex-col items-center min-w-[max-content] transition-opacity duration-200 z-10 pointer-events-none">
                                <span class="text-[10px] font-bold text-emerald-600 group-hover:text-emerald-700">PT</span>
                                <span class="text-xs font-black text-slate-800 bg-white px-2 py-0.5 rounded shadow-sm">{{ $eduMode == 'percentage' ? $pt . '%' : number_format($pt) }}</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-[9px] text-center font-bold text-slate-400 uppercase mt-2">
                        @if($eduMode == 'percentage')
                               Data dalam Persentase
                        @else
                               Data dalam Jumlah Jiwa
                        @endif
                    </p>
                </div>
            </div>

            <!-- Religion (Dynamic) -->
            @php
                $rel = $demografis->agama ?? [];
                $relMode = $rel['mode'] ?? 'percentage';
                $religions = ['islam' => 'Islam', 'kristen' => 'Kristen', 'katolik' => 'Katolik', 'hindu' => 'Hindu', 'buddha' => 'Buddha', 'konghucu' => 'Konghucu'];
                $colors = ['islam' => 'emerald', 'kristen' => 'blue', 'katolik' => 'purple', 'hindu' => 'amber', 'buddha' => 'orange', 'konghucu' => 'red'];

                $totalRel = 0;
                foreach ($religions as $key => $label) {
                    $totalRel += ($rel[$key] ?? 0);
                }

                $lainnya = 0;
                if ($relMode == 'percentage') {
                    $lainnya = 100 - $totalRel;
                    $lainnyaLabel = "LAINNYA";
                    $maxVal = 100;
                } else {
                    $lainnya = max(0, $penduduk - $totalRel);
                    $lainnyaLabel = "AGAMA LAINNYA";
                    $maxVal = $penduduk > 0 ? $penduduk : 1;
                }
            @endphp
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Proporsi Agama</h3>
                <div class="flex-1 flex flex-col gap-4 bg-slate-50 rounded-2xl p-6 overflow-y-auto custom-scrollbar">
                    @foreach($religions as $key => $label)
                        @if(($rel[$key] ?? 0) > 0)
                            @php 
                                                                                                                                $val = $rel[$key];
                                $percent = $relMode == 'percentage' ? $val : ($penduduk > 0 ? round(($val / $penduduk) * 100) : 0);
                                $color = $colors[$key];
                            @endphp
                            <div class="space-y-1">
                                <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">{{ $label }}</span> <span class="text-{{ $color }}-600">{{ $relMode == 'percentage' ? $val . '%' : number_format($val) }}</span></div>
                                <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-{{ $color }}-500 h-full w-[{{ $percent }}%]"></div></div>
                            </div>
                        @endif
                    @endforeach

                    @if($lainnya > 0)
                         @php 
                            $percentLain = $relMode == 'percentage' ? $lainnya : ($penduduk > 0 ? round(($lainnya / $penduduk) * 100) : 0);
                         @endphp
                        <div class="space-y-1">
                            <div class="flex justify-between text-[10px] font-black uppercase"><span class="text-slate-600">{{ $lainnyaLabel }}</span> <span class="text-slate-400">{{ $relMode == 'percentage' ? $lainnya . '%' : number_format($lainnya) }}</span></div>
                            <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden"><div class="bg-slate-400 h-full w-[{{ $percentLain }}%]"></div></div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Occupation (Dynamic) -->
            @php
                $job = $demografis->mata_pencaharian ?? [];
                $jobMode = $job['mode'] ?? 'percentage';
                $jobData = $job['data'] ?? []; // Array of ['name' => '...', 'amount' => ...]

                $totalJob = 0;
                foreach ($jobData as $j) {
                    $totalJob += ($j['amount'] ?? 0);
                }

                $jobLainnya = 0;
                if ($jobMode == 'percentage') {
                    $jobLainnya = 100 - $totalJob;
                    $jobLainnyaLabel = "Nilai Lainnya";
                } else {
                    $jobLainnya = max(0, $penduduk - $totalJob);
                    $jobLainnyaLabel = "Lainnya";
                }

                // Colors cycler
                $jobColors = ['emerald', 'blue', 'amber', 'purple', 'pink', 'indigo'];
            @endphp
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col min-h-[350px]">
                <h3 class="text-center font-bold text-slate-900 mb-6 uppercase text-[10px] tracking-widest">Mata Pencaharian</h3>
                <div class="flex-1 flex flex-col justify-center bg-slate-50 rounded-2xl p-6 overflow-y-auto custom-scrollbar">
                    <div class="space-y-4">
                        @foreach($jobData as $index => $item)
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-10 bg-{{ $jobColors[$index % count($jobColors)] }}-500 rounded-full"></div>
                                <div>
                                    <p class="text-xl font-black text-slate-900 leading-none">{{ $item['name'] }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                        @if($jobMode == 'percentage')
                                            {{ $item['amount'] }}%
                                        @else
                                            {{ number_format($item['amount']) }} Jiwa
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        @if($jobLainnya > 0)
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-10 bg-slate-400 rounded-full"></div>
                                <div>
                                    <p class="text-xl font-black text-slate-900 leading-none">{{ $jobLainnyaLabel }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                        @if($jobMode == 'percentage')
                                            {{ $jobLainnya }}%
                                        @else
                                            {{ number_format($jobLainnya) }} Jiwa
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- Struktur Organisasi Section -->
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
                    <h2 class="text-3xl font-bold">Data Geografis</h2>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-white/10 rounded-xl shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-400"><path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/><path d="M7 3.34V5a3 3 0 0 0 3 3a2 2 0 0 1 2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2c0-1.1.9-2 2-2h3.17"/><path d="M11 21.95V18a2 2 0 0 0-2-2a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/><circle cx="12" cy="12" r="10"/></svg>
                            </div>
                            <div class="space-y-2 w-full">
                                <p class="text-emerald-400 font-bold text-sm">Wilayah Administrasi</p>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-slate-400 text-xs">Luas Wilayah</p>
                                        <p class="text-white font-medium">{{ $profile->luas_wilayah ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-xs">Jumlah Dusun</p>
                                        <p class="text-white font-medium">4</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                             <div class="p-3 bg-white/10 rounded-xl shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-400"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            </div>
                            <div class="space-y-2 w-full">
                                <p class="text-emerald-400 font-bold text-sm">Batas Wilayah</p>
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                    <div>
                                        <p class="text-slate-400 text-xs">Utara</p>
                                        <p class="text-white font-medium">Desa Sidorahayu</p>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-xs">Timur</p>
                                        <p class="text-white font-medium">Desa Sitirejo</p>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-xs">Selatan</p>
                                        <p class="text-white font-medium">Desa Mendalanwangi</p>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 text-xs">Barat</p>
                                        <p class="text-white font-medium">Desa Godowangi</p>
                                    </div>
                                </div>
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
