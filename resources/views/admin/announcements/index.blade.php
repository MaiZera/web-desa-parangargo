<x-admin-layout>
    <x-slot name="header">
        Pengumuman
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                        <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                            <h2 class="text-xl font-semibold whitespace-nowrap">Daftar Pengumuman</h2>

                            <form action="{{ route('admin.announcements.index') }}" method="GET"
                                class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                <select name="tipe" onchange="this.form.submit()"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                    <option value="">Semua Tipe</option>
                                    <option value="umum" {{ request('tipe') == 'umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="agenda" {{ request('tipe') == 'agenda' ? 'selected' : '' }}>Agenda
                                    </option>
                                    <option value="layanan" {{ request('tipe') == 'layanan' ? 'selected' : '' }}>Layanan
                                    </option>
                                    <option value="darurat" {{ request('tipe') == 'darurat' ? 'selected' : '' }}>Darurat
                                    </option>
                                    <option value="berita" {{ request('tipe') == 'berita' ? 'selected' : '' }}>Berita
                                    </option>
                                </select>

                                <select name="status" onchange="this.form.submit()"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                    <option value="">Semua Status</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>
                                        Archived</option>
                                </select>

                                @if(request('tipe') || request('status'))
                                    <a href="{{ route('admin.announcements.index') }}"
                                        class="px-3 py-2 bg-gray-100 text-gray-600 rounded-md hover:bg-gray-200 text-sm flex items-center justify-center">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>

                        <a href="{{ route('admin.announcements.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors text-center whitespace-nowrap">
                            + Tambah Pengumuman
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Judul & Tipe
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Status &
                                        Tanggal</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($announcements as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3">
                                                <!-- Attachment Preview -->
                                                @if($item->file_lampiran)
                                                    <div
                                                        class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                        @php
                                                            $ext = pathinfo($item->file_lampiran, PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset('storage/' . $item->file_lampiran) }}" alt="Preview"
                                                                class="w-full h-full object-cover">
                                                        @else
                                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div
                                                        class="flex-shrink-0 w-20 h-20 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center">
                                                        <span class="text-xs text-gray-300">No Image</span>
                                                    </div>
                                                @endif

                                                <div>
                                                    <div class="font-medium text-gray-900 line-clamp-2"
                                                        title="{{ $item->judul }}">
                                                        {{ $item->judul }}
                                                    </div>
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                        {{ ucfirst($item->tipe) }}
                                                    </span>
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
                                            <div class="text-xs text-gray-400">
                                                @if($item->tipe === 'agenda')
                                                    {{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d M Y') : 'Now' }}
                                                    s/d
                                                    {{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d M Y') : 'Seterusnya' }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->author->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3 text-gray-400">
                                                <a href="{{ route('admin.announcements.edit', $item->id) }}"
                                                    class="hover:text-emerald-600 transition-colors" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.announcements.destroy', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');"
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

                        @if($announcements->isEmpty())
                            <div class="p-6 text-center text-gray-500">
                                Belum ada pengumuman yang ditambahkan.
                            </div>
                        @else
                            <div class="p-4">
                                {{ $announcements->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>