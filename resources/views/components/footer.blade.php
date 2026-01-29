<footer class="bg-white text-slate-600 py-12 mt-12 border-t border-slate-200">
  <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div>
      <h3 class="text-slate-900 font-bold text-xs uppercase tracking-wider mb-5">Kontak Kami</h3>
      <ul class="space-y-3 text-[12px] text-slate-500">
        @if(isset($profile->email))
          <li class="flex items-center gap-2" title="{{ $profile->email }}"><svg xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-3 h-3 flex-shrink-0">
              <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
              <rect x="2" y="4" width="20" height="16" rx="2"></rect>
            </svg> <span class="truncate">{{ $profile->email }}</span></li>
        @endif
        @if(isset($profile->telepon))
          <li class="flex items-center gap-2" title="{{ $profile->telepon }}"><svg xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-3 h-3 flex-shrink-0">
              <path
                d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384">
              </path>
            </svg> <span class="truncate">{{ $profile->telepon }}</span></li>
        @endif
        @if(isset($profile->alamat))
          <li class="flex items-start gap-2" title="{{ $profile->alamat }}"><svg xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3 flex-shrink-0 mt-0.5">
              <path
                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
              </path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg> <span class="line-clamp-2">{{ $profile->alamat }}</span></li>
        @endif
      </ul>
    </div>
    <div>
      <h3 class="text-slate-900 font-bold text-xs uppercase tracking-wider mb-5">Jam Pelayanan</h3>
      <ul class="space-y-3 text-[12px] text-slate-500">
        <li class="flex justify-between"><span>Senin - Kamis:</span>
          <span>{{ $profile->jam_kerja_senin_kamis ?? '08:00 - 15:00' }}</span></li>
        <li class="flex justify-between"><span>Jumat:</span>
          <span>{{ $profile->jam_kerja_jumat ?? '08:00 - 11:30' }}</span></li>
        @if(isset($profile->jam_kerja_sabtu_minggu) && $profile->jam_kerja_sabtu_minggu != 'Libur')
          <li class="flex justify-between"><span>Sabtu - Minggu:</span>
            <span>{{ $profile->jam_kerja_sabtu_minggu }}</span></li>
        @endif
      </ul>
    </div>
    <div>
      <h3 class="text-slate-900 font-bold text-xs uppercase tracking-wider mb-5">Didukung Oleh</h3>
      <div class="grid grid-cols-3 gap-2">
        @if(isset($sponsors) && $sponsors->count() > 0)
          @foreach($sponsors as $sponsor)
            <div class="h-10 border rounded flex items-center justify-center overflow-hidden bg-white p-1"
              title="{{ $sponsor->nama }}">
              @if($sponsor->logo)
                <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->nama }}"
                  class="max-h-full max-w-full object-contain">
              @else
                <span class="text-[8px] font-bold text-slate-400">{{ $sponsor->nama }}</span>
              @endif
            </div>
          @endforeach
        @else
          <!-- Fallback if no sponsors -->
          <div
            class="h-10 border rounded flex items-center justify-center text-[8px] font-black bg-slate-50 text-slate-400">
            PARTNER</div>
        @endif
      </div>
    </div>
    <div>
      <h3 class="text-slate-900 font-bold text-xs uppercase tracking-wider mb-5">Ikuti Kami</h3>
      <ul class="space-y-4 text-[12px] text-slate-600">
        @if($profile->facebook)
          <li class="flex items-center gap-3">
            <a href="{{ $profile->facebook }}" target="_blank"
              class="flex items-center gap-3 hover:text-emerald-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
              </svg>
              Facebook
            </a>
          </li>
        @endif
        @if($profile->instagram)
          <li class="flex items-center gap-3">
            <a href="{{ $profile->instagram }}" target="_blank"
              class="flex items-center gap-3 hover:text-emerald-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
              </svg>
              Instagram
            </a>
          </li>
        @endif
        @if($profile->twitter)
          <li class="flex items-center gap-3">
            <a href="{{ $profile->twitter }}" target="_blank"
              class="flex items-center gap-3 hover:text-emerald-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <path
                  d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
              </svg>
              Twitter
            </a>
          </li>
        @endif
        @if($profile->youtube)
          <li class="flex items-center gap-3">
            <a href="{{ $profile->youtube }}" target="_blank"
              class="flex items-center gap-3 hover:text-emerald-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <path
                  d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17" />
                <path d="m10 15 5-3-5-3z" />
              </svg>
              YouTube
            </a>
          </li>
        @endif
        @if($profile->tiktok)
          <li class="flex items-center gap-3">
            <a href="{{ $profile->tiktok }}" target="_blank"
              class="flex items-center gap-3 hover:text-emerald-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" />
              </svg>
              TikTok
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
  <div
    class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center text-[11px] text-slate-400 gap-4">
    <p>2026 Desa Parangargo. KKN 14 UNMER 2026.</p>
    <div class="flex gap-4"><span>Negara: Indonesia</span><span>Wilayah: Jawa Timur</span></div>
  </div>
</footer>
