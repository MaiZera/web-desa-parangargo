<x-admin-layout>
    <x-slot name="header">
        Berita Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-semibold">Daftar Berita</h2>
                    </div>

                    <div class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
                        <form method="GET" action="{{ route('admin.news.index') }}"
                            class="flex flex-row items-center gap-2 w-full lg:w-auto">
                            <select name="status" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-32">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                    Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived
                                </option>
                            </select>

                            <select name="category" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-40">
                                <option value="">Semua Kategori</option>
                                @foreach($allCategories as $cat)
                                    <option value="{{ $cat->name }}" {{ is_array(request('category')) && in_array($cat->name, request('category')) ? 'selected' : (request('category') == $cat->name ? 'selected' : '') }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Berita..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-48">
                        </form>

                        <a href="{{ route('admin.news.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors whitespace-nowrap">
                            + Tambah Berita
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div id="search-results" class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Judul &
                                        Kategori</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($news as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                                        class="w-20 h-20 rounded-lg object-cover shrink-0">
                                                @else
                                                    <div
                                                        class="w-20 h-20 rounded-lg bg-gray-200 flex items-center justify-center shrink-0">
                                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium text-gray-900 line-clamp-2"
                                                        title="{{ $item->title }}">{{ $item->title }}</div>
                                                    <div class="flex flex-wrap gap-1 mt-1">
                                                        @foreach($item->categories as $category)
                                                            @php
                                                                $currentCats = (array) request('category', []);
                                                                $isActive = in_array($category->name, $currentCats);
                                                                $newCats = $currentCats;
                                                                if (!$isActive) {
                                                                    $newCats[] = $category->name;
                                                                }
                                                                $routeParams = array_merge(request()->query(), ['category' => $newCats]);
                                                            @endphp
                                                            <a href="{{ route('admin.news.index', $routeParams) }}"
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-medium transition-colors hover:bg-blue-200 {{ $isActive ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800' }}">
                                                                #{{ $category->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div class="mb-1">
                                                @if($item->status == 'published')
                                                    <span
                                                        class="px-2 py-1 text-xs text-green-700 bg-green-100 rounded-full">Published</span>
                                                @elseif($item->status == 'draft')
                                                    <span
                                                        class="px-2 py-1 text-xs text-yellow-700 bg-yellow-100 rounded-full">Draft</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs text-gray-700 bg-gray-100 rounded-full">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->author->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3 text-gray-400">
                                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                                    class="hover:text-emerald-600 transition-colors" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus berita ini?');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:text-red-600 transition-colors"
                                                        title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($news->isEmpty())
                            <div class="p-6 text-center text-gray-500">
                                Belum ada berita yang ditambahkan.
                            </div>
                        @else
                            <div class="p-4">
                                {{ $news->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.querySelector('input[name="search"]');
                const resultsContainer = document.getElementById('search-results');
                let timeoutId;

                searchInput.addEventListener('input', function () {
                    clearTimeout(timeoutId);
                    const query = this.value;

                    timeoutId = setTimeout(() => {
                        // Update URL without reloading
                        const url = new URL(window.location.href);
                        if (query) {
                            url.searchParams.set('search', query);
                        } else {
                            url.searchParams.delete('search');
                        }
                        url.searchParams.delete('page');

                        // Keep existing filters
                        const category = document.querySelector('select[name="category"]').value;
                        const status = document.querySelector('select[name="status"]').value;
                        if(category) url.searchParams.set('category', category);
                        if(status) url.searchParams.set('status', status);

                        window.history.pushState({}, '', url);

                        fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newResults = doc.getElementById('search-results');
                                if (newResults) {
                                    resultsContainer.innerHTML = newResults.innerHTML;
                                }
                            })
                            .catch(error => console.error('Error fetching results:', error));
                    }, 300);
                });
            });
        </script>
    @endpush
</x-admin-layout>