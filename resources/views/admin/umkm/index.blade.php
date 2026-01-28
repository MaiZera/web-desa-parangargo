<x-admin-layout>
    <x-slot name="header">
        Kelola UMKM Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-semibold">Daftar UMKM</h2>
                    </div>

                    <div class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
                        <form method="GET" action="{{ route('admin.umkm.index') }}"
                            class="flex flex-row items-center gap-2 w-full lg:w-auto">
                            <select name="status" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-32">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                    Non-Aktif</option>
                            </select>

                            <select name="category" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-40">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari UMKM..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-48">
                        </form>

                        <a href="{{ route('admin.umkm.create') }}"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors whitespace-nowrap">
                            + Tambah UMKM
                        </a>
                    </div>

                    @if(session('success'))
                        <div
                            class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div id="search-results" class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="p-4 font-bold text-slate-700">Nama Usaha / Pemilik</th>
                                    <th class="p-4 font-bold text-slate-700">Kategori</th>
                                    <th class="p-4 font-bold text-slate-700">Lokasi / Kontak</th>
                                    <th class="p-4 font-bold text-slate-700">Status</th>
                                    <th class="p-4 font-bold text-slate-700 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($umkms as $umkm)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                        <td class="p-4">
                                            <div class="font-bold text-slate-800">{{ $umkm->nama_usaha }}</div>
                                            <div class="text-sm text-slate-500">Oleh: {{ $umkm->nama_pemilik }}</div>
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $umkm->kategori }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm text-slate-600">
                                            <div>{{ Str::limit($umkm->alamat, 30) }}</div>
                                            <div class="text-slate-400 mt-1">{{ $umkm->telepon ?? '-' }}</div>
                                        </td>
                                        <td class="p-4">
                                            @if($umkm->is_active)
                                                <span
                                                    class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">Aktif</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="{{ route('admin.umkm.edit', $umkm) }}"
                                                class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                                            <form action="{{ route('admin.umkm.destroy', $umkm) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 font-bold text-xs uppercase"
                                                    onclick="return confirm('Hapus UMKM ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-slate-500 italic">Belum ada UMKM
                                            terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $umkms->links() }}
                    </div>
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
                        if (category) url.searchParams.set('category', category);
                        if (status) url.searchParams.set('status', status);

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