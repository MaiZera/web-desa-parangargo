<x-admin-layout>
    <x-slot name="header">
        Kelola Agenda Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-semibold">Daftar Agenda</h2>
                    </div>

                    <div class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
                        <form action="{{ route('admin.agendas.index') }}" method="GET"
                            class="flex flex-row items-center gap-2 w-full lg:w-auto">
                            <div class="flex flex-row gap-2 items-center">
                                <select name="status_publikasi" onchange="this.form.submit()"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm py-1.5 w-auto">
                                    <option value="">Semua Postingan</option>
                                    <option value="draft" {{ request('status_publikasi') == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="published" {{ request('status_publikasi') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>

                                <select name="status_kegiatan" onchange="this.form.submit()"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm py-1.5 w-auto">
                                    <option value="">Semua Kegiatan</option>
                                    <option value="scheduled" {{ request('status_kegiatan') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="ongoing" {{ request('status_kegiatan') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ request('status_kegiatan') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ request('status_kegiatan') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari Agenda..."
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-64">
                            </div>
                        </form>

                        <a href="{{ route('admin.agendas.create') }}"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors whitespace-nowrap">
                            + Tambah Agenda
                        </a>
                    </div>

                    <div id="search-results" class="overflow-x-auto">

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200">
                                        <th class="p-4 font-bold text-slate-700">Tanggal</th>
                                        <th class="p-4 font-bold text-slate-700">Judul Agenda</th>
                                        <th class="p-4 font-bold text-slate-700">Lokasi</th>
                                        <th class="p-4 font-bold text-slate-700">Status</th>
                                        <th class="p-4 font-bold text-slate-700 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($agendas as $agenda)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                            <td class="p-4">
                                                {{ $agenda->tanggal_mulai->format('d M Y') }}
                                                <br>
                                                <span
                                                    class="text-xs text-slate-500">{{ $agenda->tanggal_mulai->format('H:i') }}</span>
                                            </td>
                                            <td class="p-4 font-medium">{{ $agenda->judul }}</td>
                                            <td class="p-4 text-slate-600">{{ $agenda->lokasi ?? '-' }}</td>
                                            <td class="p-4">
                                                <div class="flex flex-col gap-1 items-start">
                                                    <!-- Status Kegiatan -->
                                                    <span class="px-2 py-1 rounded-full text-xs font-bold uppercase
                                                                @if($agenda->status_kegiatan == 'scheduled') bg-blue-100 text-blue-700 
                                                                @elseif($agenda->status_kegiatan == 'ongoing') bg-amber-100 text-amber-700 
                                                                @elseif($agenda->status_kegiatan == 'completed') bg-emerald-100 text-emerald-700 
                                                                @elseif($agenda->status_kegiatan == 'cancelled') bg-red-100 text-red-700 
                                                                @else bg-gray-100 text-gray-700 @endif
                                                            ">
                                                        {{ ucfirst($agenda->status_kegiatan) }}
                                                    </span>

                                                    <!-- Status Publikasi -->
                                                    <span class="px-2 py-1 rounded-full text-xs font-bold uppercase
                                                                @if($agenda->status_publikasi == 'published') bg-green-100 text-green-700 border border-green-200
                                                                @else bg-gray-100 text-gray-700 border border-gray-200 @endif
                                                            ">
                                                        {{ ucfirst($agenda->status_publikasi) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="p-4 text-right space-x-2">
                                                <a href="{{ route('admin.agendas.edit', $agenda) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                                                <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-bold text-xs uppercase"
                                                        onclick="return confirm('Hapus agenda ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="p-8 text-center text-slate-500 italic">Belum ada agenda
                                                terdaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $agendas->links() }}
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
