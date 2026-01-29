@extends('layouts.main')

@section('content')
    <div class="py-12 px-4 max-w-5xl mx-auto space-y-12">
        <div class="text-center space-y-4">
            <div class="inline-flex p-3 bg-emerald-100 text-emerald-600 rounded-2xl mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-megaphone">
                    <path d="m3 11 18-5v12L3 14v-3z" />
                    <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold">Pengumuman Resmi</h1>
            <p class="text-lg text-slate-600">Informasi resmi dari Pemerintah Desa Parangargo untuk seluruh warga.</p>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button onclick="filterAnnouncement('Semua')"
                class="filter-btn active px-6 py-2 rounded-full text-sm font-bold transition-all bg-emerald-600 text-white shadow-lg"
                data-type="Semua">
                Semua
            </button>
            <button onclick="filterAnnouncement('urgent')"
                class="filter-btn px-6 py-2 rounded-full text-sm font-bold transition-all bg-white text-slate-500 hover:bg-red-50 hover:text-red-600 border border-slate-200"
                data-type="urgent">
                Urgent
            </button>
            <button onclick="filterAnnouncement('penting')"
                class="filter-btn px-6 py-2 rounded-full text-sm font-bold transition-all bg-white text-slate-500 hover:bg-amber-50 hover:text-amber-600 border border-slate-200"
                data-type="penting">
                Penting
            </button>
            <button onclick="filterAnnouncement('umum')"
                class="filter-btn px-6 py-2 rounded-full text-sm font-bold transition-all bg-white text-slate-500 hover:bg-blue-50 hover:text-blue-600 border border-slate-200"
                data-type="umum">
                Umum
            </button>
        </div>

        <div id="announcement-container" class="space-y-6">
            @include('pages.partials.announcement-list', ['announcements' => $announcements])
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function filterAnnouncement(type) {
            // Update UI
            $('.filter-btn').removeClass('bg-emerald-600 text-white shadow-lg').addClass('bg-white text-slate-500 border-slate-200 hover:bg-slate-50');

            // Highlight active button (custom logic for colors if desired, or just generic active class)
            // For now using simple active state like News page but we can enhance later
            $(`.filter-btn[data-type="${type}"]`).removeClass('bg-white text-slate-500 border-slate-200 hover:bg-slate-50 hover:bg-red-50 hover:text-red-600 hover:bg-amber-50 hover:text-amber-600 hover:bg-blue-50 hover:text-blue-600');

            if (type === 'urgent') {
                $(`.filter-btn[data-type="${type}"]`).addClass('bg-red-600 text-white shadow-lg');
            } else if (type === 'penting') {
                $(`.filter-btn[data-type="${type}"]`).addClass('bg-amber-500 text-white shadow-lg');
            } else if (type === 'umum') {
                $(`.filter-btn[data-type="${type}"]`).addClass('bg-blue-500 text-white shadow-lg');
            } else {
                $(`.filter-btn[data-type="${type}"]`).addClass('bg-emerald-600 text-white shadow-lg');
            }

            $.ajax({
                url: "{{ route('news.pengumuman') }}",
                type: "GET",
                data: { tipe: type },
                success: function (response) {
                    $('#announcement-container').html(response);
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        }

        // Pagination handling
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let activeType = $('.filter-btn.bg-red-600, .filter-btn.bg-amber-500, .filter-btn.bg-blue-500, .filter-btn.bg-emerald-600').data('type'); // Get active type

            $.ajax({
                url: "{{ route('news.pengumuman') }}",
                type: "GET",
                data: {
                    page: page,
                    tipe: activeType
                },
                success: function (response) {
                    $('#announcement-container').html(response);
                }
            });
        });
    </script>
@endsection