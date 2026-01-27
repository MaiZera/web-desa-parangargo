<x-admin-layout>
    <x-slot name="header">
        Manajemen Kategori
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center gap-4">
                            <h2 class="text-xl font-semibold">Daftar Kategori</h2>
                            <form method="GET" action="{{ route('admin.categories.index') }}">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari kategori..."
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-64">
                            </form>
                        </div>
                        <a href="{{ route('admin.categories.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors">
                            + Tambah Kategori
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
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Nama Kategori
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($categories as $category)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.news.index', ['category' => $category->name]) }}"
                                                class="font-medium text-emerald-600 hover:text-emerald-800 hover:underline transition-colors">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3 text-gray-400">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                    class="hover:text-emerald-600 transition-colors" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?');"
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

                        @if($categories->isEmpty())
                            <div class="p-6 text-center text-gray-500">
                                Belum ada kategori yang ditambahkan.
                            </div>
                        @else
                            <div class="p-4">
                                {{ $categories->links() }}
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
                        // Reset pagination to page 1 on search
                        url.searchParams.delete('page');

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
                    }, 300); // 300ms debounce
                });
            });
        </script>
    @endpush
</x-admin-layout>