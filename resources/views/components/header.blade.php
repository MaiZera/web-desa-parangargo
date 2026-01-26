<header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100">
  <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
    <a class="flex items-center gap-2 group" href="{{ url('/') }}">
      <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold group-hover:rotate-12 transition-transform">D</div>
      <div>
        <h1 class="font-bold text-lg leading-none">Parangargo</h1>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Digital Village Portal</p>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-6">
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('/') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/') }}">
          Home
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('tentang') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/tentang') }}">
          Tentang Desa
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('layanan') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/layanan') }}">
          Layanan Publik
        </a>
      </div>
      <div class="relative group py-4">
        <a class="text-sm font-semibold transition-colors flex items-center gap-1.5 {{ Request::is('berita') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}" href="{{ url('/berita') }}">
          Berita
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3.5 h-3.5 transition-transform" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>
        </a>
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
