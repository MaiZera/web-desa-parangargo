@extends('layouts.main')

@section('content')
    <div class="py-12 px-4 max-w-7xl mx-auto space-y-12">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6">
            <div class="max-w-xl">
                <h1 class="text-4xl font-bold mb-4">Artikel &amp; Kabar Desa</h1>
                <p class="text-lg text-slate-600">Liputan mendalam tentang perkembangan, budaya, dan inovasi di Desa
                    Parangargo.</p>
            </div>

            <div class="w-full md:w-auto flex flex-col items-end gap-4">
                <!-- Search Input -->
                <div class="relative w-full md:w-64">
                    <input type="text" id="searchInput" placeholder="Cari artikel..."
                        class="w-full pl-10 pr-4 py-2 rounded-full border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Categories -->
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide max-w-[100vw] md:max-w-md">
                    <button onclick="filterCategory('Semua')"
                        class="category-btn active px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-emerald-600 text-white shadow-lg"
                        data-category="Semua">Semua</button>
                    @foreach($categories as $cat)
                        <button onclick="filterCategory('{{ $cat->slug }}')"
                            class="category-btn px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-white text-slate-500 hover:bg-slate-50 border border-slate-200"
                            data-category="{{ $cat->slug }}">{{ $cat->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Featured News (Optional: You can also make this dynamic if needed, for now I'll check if there is a featured article or just use latest) -->
        @if($news->first() && $news->onFirstPage())
            @php $featured = $news->first(); @endphp
            <section class="relative h-[450px] rounded-[3rem] overflow-hidden group cursor-pointer"
                onclick="window.location='{{ route('news.show', $featured->slug) }}'">
                @if($featured->image)
                    <img alt="{{ $featured->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="{{ asset('storage/' . $featured->image) }}">
                @else
                    <img alt="{{ $featured->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="https://placehold.co/1200x800/e2e8f0/64748b?text=Berita+Utama">
                @endif
                <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent flex items-end p-8 md:p-16">
                    <div class="max-w-3xl space-y-4">
                        @if($featured->categories->count() > 0)
                            <span
                                class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $featured->categories->first()->name }}</span>
                        @endif
                        <h2 class="text-3xl md:text-5xl font-bold text-white leading-tight">{{ $featured->title }}</h2>
                        <p class="text-slate-200 line-clamp-2 text-lg">
                            {{ Str::limit(strip_tags($featured->summary ?? $featured->content), 150) }}</p>
                        <div class="flex items-center gap-4 text-emerald-400 font-medium">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar w-4 h-4" aria-hidden="true">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                {{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}
                            </span>
                            <a href="{{ route('news.show', $featured->slug) }}"
                                class="flex items-center gap-1 hover:underline">Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <div id="news-grid-container" class="grid md:grid-cols-3 gap-8">
            @include('pages.partials.news-grid', ['news' => $news])
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentCategory = 'Semua';
        let searchQuery = '';
        let debounceTimer;

        function fetchNews(page = 1) {
            $.ajax({
                url: "{{ route('news.artikel') }}",
                type: "GET",
                data: {
                    page: page,
                    search: searchQuery,
                    category: currentCategory
                },
                success: function (response) {
                    $('#news-grid-container').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function filterCategory(slug) {
            currentCategory = slug;

            // Update UI buttons
            $('.category-btn').removeClass('bg-emerald-600 text-white shadow-lg').addClass('bg-white text-slate-500 hover:bg-slate-50 border-slate-200');
            $(`.category-btn[data-category="${slug}"]`).removeClass('bg-white text-slate-500 hover:bg-slate-50 border-slate-200').addClass('bg-emerald-600 text-white shadow-lg');

            fetchNews(1);
        }

        $('#searchInput').on('input', function () {
            clearTimeout(debounceTimer);
            searchQuery = $(this).val();

            debounceTimer = setTimeout(function () {
                fetchNews(1);
            }, 500);
        });

        // Handle pagination links
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchNews(page);
        });
    </script>
@endsection