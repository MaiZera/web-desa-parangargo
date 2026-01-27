<x-admin-layout>
    <x-slot name="header">
        Kelola Sponsor
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-semibold">Daftar Sponsor</h2>
                    </div>

                    <div class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
                        <form action="{{ route('admin.sponsors.index') }}" method="GET"
                            class="flex flex-row items-center gap-2 w-full lg:w-auto">
                            <select name="is_active" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-32">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>

                            @if(isset($categories) && count($categories) > 0)
                                <select name="kategori" onchange="this.form.submit()"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-40">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Sponsor..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-48">
                        </form>

                        <a href="{{ route('admin.sponsors.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors whitespace-nowrap">
                            + Tambah Sponsor
                        </a>
                    </div>

                    <div id="search-results" class="overflow-x-auto">

                        @if(session('success'))
                            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200">
                                        <th class="p-4 font-bold text-slate-700">Logo</th>
                                        <th class="p-4 font-bold text-slate-700">Nama</th>
                                        <th class="p-4 font-bold text-slate-700">Masa Aktif</th>
                                        <th class="p-4 font-bold text-slate-700">Kontak</th>
                                        <th class="p-4 font-bold text-slate-700">Status</th>
                                        <th class="p-4 font-bold text-slate-700 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sponsors as $item)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                            <td class="p-4">
                                                @if($item->logo)
                                                    <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->nama }}"
                                                        class="h-10 w-auto object-contain">
                                                @else
                                                    <span class="text-xs text-gray-400">No Logo</span>
                                                @endif
                                            </td>
                                            <td class="p-4">
                                                <div class="font-medium text-slate-900">{{ $item->nama }}</div>
                                                <div class="text-xs text-slate-500">Urutan:{{ $item->urutan }}</div>
                                            </td>
                                            <td class="p-4 text-sm text-slate-600">
                                                @if($item->start_date && $item->end_date)
                                                    {{ $item->start_date->format('d M Y') }} -
                                                    {{ $item->end_date->format('d M Y') }}
                                                @elseif($item->start_date)
                                                    Mulai: {{ $item->start_date->format('d M Y') }}
                                                @elseif($item->end_date)
                                                    Sampai: {{ $item->end_date->format('d M Y') }}
                                                @else
                                                    Selamanya
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm text-slate-600">
                                                @if($item->website)
                                                    <a href="{{ $item->website }}" target="_blank"
                                                        class="text-indigo-600 hover:underline block">Website</a>
                                                @endif
                                                @if($item->instagram)
                                                    <a href="https://instagram.com/{{ trim($item->instagram, '@') }}"
                                                        target="_blank"
                                                        class="text-pink-600 hover:underline block">Instagram</a>
                                                @endif
                                            </td>
                                            <td class="p-4">
                                                <span
                                                    class="px-2 py-1 text-xs font-bold rounded-full {{ $item->is_active ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                                    {{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-right space-x-2">
                                                <a href="{{ route('admin.sponsors.edit', $item) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-bold text-xs uppercase">Edit</a>
                                                <form action="{{ route('admin.sponsors.destroy', $item) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('Hapus sponsor ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 font-bold text-xs uppercase">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-slate-500 italic">Belum ada sponsor.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $sponsors->links() }}
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
                            const isActive = document.querySelector('select[name="is_active"]').value;
                            const kategori = document.querySelector('select[name="kategori"]');

                            if (isActive) url.searchParams.set('is_active', isActive);
                            if (kategori && kategori.value) url.searchParams.set('kategori', kategori.value);

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