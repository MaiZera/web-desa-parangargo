<header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100">
  <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
    <a class="flex items-center gap-2 group" href="{{ url('/') }}">
      <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold group-hover:rotate-12 transition-transform">D</div>
      <div>
        <h1 class="font-bold text-lg leading-none">Parangargo</h1>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Digital Village Portal</p>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-8">
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('/') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}" href="{{ url('/') }}">
          Home
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('tentang') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}" href="{{ url('/tentang') }}">
          Tentang
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('layanan') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}" href="{{ url('/layanan') }}">
          Layanan
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('berita*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}" href="{{ url('/berita') }}">
          Berita
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 transition-transform group-hover:rotate-180" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>
        </a>
        <!-- Dropdown Menu -->
        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-0 w-64 bg-white/95 backdrop-blur-xl rounded-[2rem] shadow-[0_32px_80px_-16px_rgba(0,0,0,0.15)] border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <div class="p-3 space-y-1">
            <a href="{{ route('news.artikel') }}" class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-emerald-600 hover:text-white transition-all group/item {{ Request::is('berita/artikel') ? 'bg-emerald-50 text-emerald-600' : '' }}">
              <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
              </div>
              <div>
                <p class="font-black leading-none">Artikel</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Kabar & Inovasi</p>
              </div>
            </a>
            <a href="{{ route('news.pengumuman') }}" class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-red-600 hover:text-white transition-all group/item {{ Request::is('berita/pengumuman') ? 'bg-red-50 text-red-600' : '' }}">
              <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
              </div>
              <div>
                <p class="font-black leading-none">Pengumuman</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Informasi Resmi</p>
              </div>
            </a>
            <a href="{{ route('news.laporan') }}" class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-indigo-600 hover:text-white transition-all group/item {{ Request::is('berita/laporan') ? 'bg-indigo-50 text-indigo-600' : '' }}">
              <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
              </div>
              <div>
                <p class="font-black leading-none">Laporan</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Dokumentasi Kerja</p>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('transparansi') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/transparansi') }}">
          Transparansi
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('umkm') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/umkm') }}">
          UMKM
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('galeri') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/galeri') }}">
          Galeri
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('partisipasi') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/partisipasi') }}">
          Partisipasi
        </a>
      </div>
    </nav>
    <button class="lg:hidden p-2 text-slate-600">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu w-6 h-6" aria-hidden="true"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg>
    </button>
  </div>
</header>
