@forelse($news as $item)
    <article
        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group cursor-pointer"
        onclick="window.location='{{ route('news.show', $item->slug) }}'">
        <div class="h-56 overflow-hidden relative">
            @if($item->image)
                <img alt="{{ $item->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    src="{{ asset('storage/' . $item->image) }}">
            @else
                <img alt="{{ $item->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    src="https://placehold.co/600x400/e2e8f0/64748b?text=Berita+Desa">
            @endif
            <!-- Category Badge moved to content area as requested, but user said "moved to section below title". Wait, user said "pindah ke bagian bawah judul". So I remove it from here. -->
        </div>
        <div class="p-8 space-y-4">
            <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">{{ $item->title }}
            </h3>

            <!-- Category below title -->
            <div class="flex flex-wrap gap-2">
                @foreach($item->categories as $category)
                    <span
                        class="text-[10px] font-bold text-emerald-600 uppercase bg-emerald-50 px-2 py-1 rounded-md cursor-pointer hover:bg-emerald-100"
                        onclick="event.stopPropagation(); filterCategory('{{ $category->slug }}')">
                        #{{ $category->name }}
                    </span>
                @endforeach
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-calendar w-3.5 h-3.5" aria-hidden="true">
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
                {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
            </div>

            <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed">
                {{ Str::limit(strip_tags($item->summary ?? $item->content), 120) }}</p>

            <a href="{{ route('news.show', $item->slug) }}"
                class="pt-2 text-emerald-600 font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </a>
        </div>
    </article>
@empty
    <div class="col-span-full text-center py-12">
        <p class="text-slate-500 text-lg">Tidak ada artikel yang ditemukan.</p>
    </div>
@endforelse

@if($news->hasPages())
    <div class="col-span-full mt-8">
        {{ $news->links() }}
    </div>
@endif
