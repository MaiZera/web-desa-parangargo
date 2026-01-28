<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Hero Slider -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @if(isset($banners) && $banners->count() > 0)
            <section class="relative h-[300px] md:h-[400px] overflow-hidden rounded-2xl group" x-data="{ active: 0 }"
                x-init="setInterval(() => active = (active + 1) % {{ $banners->count() }}, 5000)">
                @foreach($banners as $index => $banner)
                    <!-- Slide {{ $index + 1 }} -->
                    <div class="absolute inset-0 transition-opacity duration-1000"
                        :class="{ 'opacity-100': active === {{ $index }}, 'opacity-0': active !== {{ $index }} }">
                        <img alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . $banner->image_path) }}">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8">
                            <div class="max-w-2xl text-white space-y-2">
                                @if($banner->title)
                                    <h1 class="text-3xl font-bold leading-tight">{{ $banner->title }}</h1>
                                @endif
                                @if($banner->description)
                                    <p class="text-sm text-slate-200">{{ $banner->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Indicators -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    @foreach($banners as $index => $banner)
                        <button class="h-2 rounded-full transition-all bg-white"
                            :class="active === {{ $index }} ? 'w-6' : 'w-2 opacity-50'" @click="active = {{ $index }}"></button>
                    @endforeach
                </div>
            </section>
        @else
            <!-- Fallback Static Banner if no banners uploaded -->
            <div class="bg-indigo-600 rounded-2xl p-8 text-white flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Selamat Datang di Dashboard Admin</h2>
                    <p class="text-indigo-100">Kelola data website desa dengan mudah dan cepat.</p>
                </div>
                <svg class="w-24 h-24 text-indigo-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
        @endif
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1: Total Berita -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Berita</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($newsStats['total']) }}</h3>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-4">
                @if($newsStats['trend'] == 'up')
                    <span class="text-green-500 text-sm font-semibold bg-green-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        +{{ $newsStats['change'] }}%
                    </span>
                @elseif($newsStats['trend'] == 'down')
                    <span class="text-red-500 text-sm font-semibold bg-red-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        -{{ $newsStats['change'] }}%
                    </span>
                @else
                    <span class="text-gray-500 text-sm font-semibold bg-gray-50 px-2 py-0.5 rounded-lg flex items-center">
                        0%
                    </span>
                @endif
                <span class="text-gray-400 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 2: Total UMKM -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total UMKM</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($umkmStats['total']) }}</h3>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-4">
                @if($umkmStats['trend'] == 'up')
                    <span class="text-green-500 text-sm font-semibold bg-green-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        +{{ $umkmStats['change'] }}%
                    </span>
                @elseif($umkmStats['trend'] == 'down')
                    <span class="text-red-500 text-sm font-semibold bg-red-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        -{{ $umkmStats['change'] }}%
                    </span>
                @else
                    <span class="text-gray-500 text-sm font-semibold bg-gray-50 px-2 py-0.5 rounded-lg flex items-center">
                        0%
                    </span>
                @endif
                <span class="text-gray-400 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 3: Visits -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Visits</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        @if($visitStats['total'] >= 1000)
                            {{ number_format($visitStats['total'] / 1000, 1) }}k
                        @else
                            {{ $visitStats['total'] }}
                        @endif
                    </h3>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-4">
                @if($visitStats['trend'] == 'up')
                    <span class="text-green-500 text-sm font-semibold bg-green-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        +{{ $visitStats['change'] }}%
                    </span>
                @elseif($visitStats['trend'] == 'down')
                    <span class="text-red-500 text-sm font-semibold bg-red-50 px-2 py-0.5 rounded-lg flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        -{{ $visitStats['change'] }}%
                    </span>
                @else
                    <span class="text-gray-500 text-sm font-semibold bg-gray-50 px-2 py-0.5 rounded-lg flex items-center">
                        0%
                    </span>
                @endif
                <span class="text-gray-400 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 4: Penduduk -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Penduduk</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        @if($totalPenduduk >= 1000)
                            {{ number_format($totalPenduduk / 1000, 1) }}k
                        @else
                            {{ number_format($totalPenduduk) }}
                        @endif
                    </h3>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center mt-4">
                <span class="text-gray-400 text-sm">Updated today</span>
            </div>
        </div>
    </div>

    <!-- Recent Content Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900">Recent Content</h2>
            <button class="text-sm text-indigo-600 font-medium hover:text-indigo-700">View All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider w-10">
                            <input type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentContent as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($item['image'])
                                        <div class="w-10 h-10 rounded-lg bg-gray-200 bg-cover bg-center shrink-0"
                                            style="background-image: url('{{ asset('storage/' . $item['image']) }}');"></div>
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0 text-indigo-600 font-bold">
                                            {{ substr($item['title'], 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900 line-clamp-1"
                                        title="{{ $item['title'] }}">{{ $item['title'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item['category_type'] }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item['date']->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4">
                                @if(in_array(strtolower($item['status']), ['published', 'active']))
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-green-600 bg-green-50 rounded-full border border-green-100">
                                        {{ ucfirst($item['status']) }}
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full border border-gray-200">
                                        {{ ucfirst($item['status']) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3 text-gray-400">
                                    <a href="{{ $item['edit_route'] }}" class="hover:text-indigo-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ $item['delete_route'] }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus item ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Belum ada konten terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>