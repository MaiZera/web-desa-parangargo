<header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100"
  x-data="{ mobileMenuOpen: false }">
  <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
    <a class="flex items-center gap-2 group" href="{{ url('/') }}">
      <div
        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform overflow-hidden shadow-sm border border-slate-50">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Kabupaten Malang" class="w-8 h-8 object-contain">
      </div>
      <div>
        <h1 class="font-bold text-lg leading-none">Desa Parangargo</h1>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Kabupaten Malang</p>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-8">
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('/') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/') }}">
          Home
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('tentang') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/tentang') }}">
          Tentang
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('layanan') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/layanan') }}">
          Layanan
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('berita*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="">
          Berita
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
            class="w-3 h-3 transition-transform group-hover:rotate-180" aria-hidden="true">
            <path d="m6 9 6 6 6-6"></path>
          </svg>
        </a>
        <!-- Dropdown Menu -->
        <div
          class="absolute top-full left-1/2 -translate-x-1/2 mt-0 w-64 bg-white/95 backdrop-blur-xl rounded-[2rem] shadow-[0_32px_80px_-16px_rgba(0,0,0,0.15)] border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <div class="p-3 space-y-1">
            <a href="{{ route('news.artikel') }}"
              class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-emerald-600 hover:text-white transition-all group/item {{ Request::is('berita/artikel') ? 'bg-emerald-50 text-emerald-600' : '' }}">
              <div
                class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                  class="w-5 h-5">
                  <path
                    d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                  <path d="M18 14h-8" />
                  <path d="M15 18h-5" />
                  <path d="M10 6h8v4h-8V6Z" />
                </svg>
              </div>
              <div>
                <p class="font-black leading-none">Artikel</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Kabar & Inovasi</p>
              </div>
            </a>
            <a href="{{ route('news.pengumuman') }}"
              class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-red-600 hover:text-white transition-all group/item {{ Request::is('berita/pengumuman') ? 'bg-red-50 text-red-600' : '' }}">
              <div
                class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                  class="w-5 h-5">
                  <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                  <path d="M8 12h.01" />
                  <path d="M12 12h.01" />
                  <path d="M16 12h.01" />
                </svg>
              </div>
              <div>
                <p class="font-black leading-none">Pengumuman</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Informasi Resmi</p>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('transparansi*') || Request::is('berita/laporan') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="javascript:void(0)">
          Transparansi
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
            class="w-3 h-3 transition-transform group-hover:rotate-180" aria-hidden="true">
            <path d="m6 9 6 6 6-6"></path>
          </svg>
        </a>
        <!-- Dropdown Menu -->
        <div
          class="absolute top-full left-1/2 -translate-x-1/2 mt-0 w-64 bg-white/95 backdrop-blur-xl rounded-[2rem] shadow-[0_32px_80px_-16px_rgba(0,0,0,0.15)] border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <div class="p-3 space-y-1">
            <a href="{{ url('/transparansi') }}"
              class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-emerald-600 hover:text-white transition-all group/item {{ Request::is('transparansi') ? 'bg-emerald-50 text-emerald-600' : '' }}">
              <div
                class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                  class="w-5 h-5">
                  <rect width="18" height="18" x="3" y="3" rx="2" />
                  <path d="M3 9h18" />
                  <path d="M9 21V9" />
                </svg>
              </div>
              <div>
                <p class="font-black leading-none">Banner APBD</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Transparansi Anggaran</p>
              </div>
            </a>
            <a href="{{ route('news.laporan') }}"
              class="flex items-center gap-4 px-5 py-4 rounded-[1.5rem] text-sm text-slate-600 hover:bg-indigo-600 hover:text-white transition-all group/item {{ Request::is('berita/laporan') ? 'bg-indigo-50 text-indigo-600' : '' }}">
              <div
                class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center transition-colors group-hover/item:bg-white/20 group-hover/item:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                  class="w-5 h-5">
                  <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                  <polyline points="14 2 14 8 20 8" />
                  <line x1="16" x2="8" y1="13" y2="13" />
                  <line x1="16" x2="8" y1="17" y2="17" />
                  <line x1="10" x2="8" y1="9" y2="9" />
                </svg>
              </div>
              <div>
                <p class="font-black leading-none">Laporan Kerja</p>
                <p class="text-[10px] mt-1 opacity-70 font-medium">Dokumentasi Kerja</p>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('umkm') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/umkm') }}">
          UMKM
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('galeri') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/galeri') }}">
          Galeri
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-[13px] font-bold uppercase tracking-widest transition-all flex items-center gap-1.5 {{ Request::is('partisipasi') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}"
          href="{{ url('/partisipasi') }}">
          Partisipasi
        </a>
      </div>
    </nav>
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-600 hover:text-emerald-600 transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-menu w-6 h-6" aria-hidden="true" x-show="!mobileMenuOpen">
        <path d="M4 5h16"></path>
        <path d="M4 12h16"></path>
        <path d="M4 19h16"></path>
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-x w-6 h-6" aria-hidden="true" x-show="mobileMenuOpen" style="display: none;">
        <path d="M18 6 6 18"></path>
        <path d="m6 6 12 12"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div x-show="mobileMenuOpen" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-4"
       @click.away="mobileMenuOpen = false"
       class="lg:hidden bg-white border-b border-slate-100 shadow-lg"
       style="display: none;">
    <nav class="max-w-7xl mx-auto px-4 py-4 space-y-1">
      <a href="{{ url('/') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('/') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        Home
      </a>
      <a href="{{ url('/tentang') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('tentang') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        Tentang
      </a>
      <a href="{{ url('/layanan') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('layanan') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        Layanan
      </a>
      
      <!-- Berita Dropdown -->
      <div x-data="{ beritaOpen: false }" class="space-y-1">
        <button @click="beritaOpen = !beritaOpen" 
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('berita*') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
          <span>Berita</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
               class="transition-transform" :class="beritaOpen ? 'rotate-180' : ''">
            <path d="m6 9 6 6 6-6"></path>
          </svg>
        </button>
        <div x-show="beritaOpen" 
             x-transition
             class="pl-4 space-y-1"
             style="display: none;">
          <a href="{{ route('news.artikel') }}" 
             class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all {{ Request::is('berita/artikel') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
              <path d="M18 14h-8" />
              <path d="M15 18h-5" />
              <path d="M10 6h8v4h-8V6Z" />
            </svg>
            <span class="font-bold">Artikel</span>
          </a>
          <a href="{{ route('news.pengumuman') }}" 
             class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all {{ Request::is('berita/pengumuman') ? 'bg-red-50 text-red-600' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
              <path d="M8 12h.01" />
              <path d="M12 12h.01" />
              <path d="M16 12h.01" />
            </svg>
            <span class="font-bold">Pengumuman</span>
          </a>
        </div>
      </div>

      <!-- Transparansi Dropdown -->
      <div x-data="{ transparansiOpen: false }" class="space-y-1">
        <button @click="transparansiOpen = !transparansiOpen" 
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('transparansi*') || Request::is('berita/laporan') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
          <span>Transparansi</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
               class="transition-transform" :class="transparansiOpen ? 'rotate-180' : ''">
            <path d="m6 9 6 6 6-6"></path>
          </svg>
        </button>
        <div x-show="transparansiOpen" 
             x-transition
             class="pl-4 space-y-1"
             style="display: none;">
          <a href="{{ url('/transparansi') }}" 
             class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all {{ Request::is('transparansi') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="18" height="18" x="3" y="3" rx="2" />
              <path d="M3 9h18" />
              <path d="M9 21V9" />
            </svg>
            <span class="font-bold">Banner APBD</span>
          </a>
          <a href="{{ route('news.laporan') }}" 
             class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all {{ Request::is('berita/laporan') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
              <polyline points="14 2 14 8 20 8" />
              <line x1="16" x2="8" y1="13" y2="13" />
              <line x1="16" x2="8" y1="17" y2="17" />
              <line x1="10" x2="8" y1="9" y2="9" />
            </svg>
            <span class="font-bold">Laporan Kerja</span>
          </a>
        </div>
      </div>

      <a href="{{ url('/umkm') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('umkm') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        UMKM
      </a>
      <a href="{{ url('/galeri') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('galeri') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        Galeri
      </a>
      <a href="{{ url('/partisipasi') }}" 
         class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all {{ Request::is('partisipasi') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">
        Partisipasi
      </a>
    </nav>
  </div>
</header>