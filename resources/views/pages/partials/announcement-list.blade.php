@forelse($announcements as $item)
    @php
        $color = 'emerald';
        $bgColor = 'bg-emerald-50';
        $textColor = 'text-emerald-600';
        // Default icon for Umum/Info
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>';

        if ($item->tipe == 'urgent') {
            $color = 'red';
            $bgColor = 'bg-red-50';
            $textColor = 'text-red-600';
            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>';
        } elseif ($item->tipe == 'penting') {
            $color = 'amber';
            $bgColor = 'bg-amber-50';
            $textColor = 'text-amber-600';
            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>';
        } elseif ($item->tipe == 'umum') {
            // Explicit styling for umum/info if needed, currently reusing defaults (emerald/bell)
            // Maybe blue for info?
            $color = 'blue';
            $bgColor = 'bg-blue-50';
            $textColor = 'text-blue-600';
            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>';
        }
    @endphp
    <!-- Message -->
    <div
        class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start group">
        <div class="p-4 rounded-2xl shrink-0 {{ $bgColor }} {{ $textColor }}">
            {!! $icon !!}
        </div>
        <div class="flex-1 space-y-3">
            <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                <span class="px-2 py-1 rounded {{ $bgColor }} {{ $textColor }}">{{ ucfirst($item->tipe) }}</span>
                <span class="text-slate-400 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-calendar">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                    </svg>
                    {{ $item->created_at->format('d M Y') }}
                </span>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">{{ $item->judul }}
            </h3>
            <p class="text-slate-600 leading-relaxed">{{ $item->konten }}</p>
        </div>
        <div class="shrink-0 flex md:flex-col gap-2 w-full md:w-auto">
            @if($item->file_lampiran)
                <a href="{{ asset('storage/' . $item->file_lampiran) }}" target="_blank"
                    class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-download">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg> Download Lampiran
                </a>
            @else
                <button disabled
                    class="flex-1 md:flex-none bg-slate-100 text-slate-400 px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-download">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg> Download Lampiran
                </button>
            @endif
        </div>
    </div>
@empty
    <div class="text-center py-12 text-slate-500">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-inbox mx-auto mb-4 text-slate-300">
            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12" />
            <path
                d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
        </svg>
        <p>Belum ada pengumuman saat ini.</p>
    </div>
@endforelse

<!-- Pagination -->
<div class="mt-8">
    {{ $announcements->links() }}
</div>
