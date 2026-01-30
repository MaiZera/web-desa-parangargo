<x-admin-layout>
    <x-slot name="header">
        Laporan Dokumen Kerja
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 text-center">
                        <h2 class="text-xl font-semibold">Daftar Laporan Proyek</h2>
                    </div>

                    <div class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
                        <form method="GET" action="{{ route('admin.project-reports.index') }}"
                            class="flex flex-row items-center gap-2 w-full lg:w-auto">

                            <select name="rt" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-32">
                                <option value="">Semua RT</option>
                                @foreach($availableRTs as $rt)
                                    <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>
                                        RT {{ $rt }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Laporan..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm px-3 py-1.5 w-full sm:w-48">
                        </form>

                        <a href="{{ route('admin.project-reports.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors whitespace-nowrap">
                            + Tambah Laporan
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
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Judul & Lokasi
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">RT/RW</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Progress</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Dana</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($reports as $report)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                @if($report->image)
                                                    <img src="{{ asset('storage/' . $report->image) }}"
                                                        alt="{{ $report->title }}"
                                                        class="w-16 h-16 rounded-lg object-cover shrink-0">
                                                @else
                                                    <div
                                                        class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center shrink-0">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $report->title }}</div>
                                                    <div class="text-xs text-gray-500">{{ $report->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div>RT: {{ $report->rt ?? '-' }}</div>
                                            <div>RW: {{ $report->rw ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-emerald-600 h-2.5 rounded-full"
                                                    style="width: {{ $report->percentage }}%"></div>
                                            </div>
                                            <span class="text-xs mt-1 block">{{ $report->percentage }}%</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $report->fund_usage_formatted }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @php
                                                $statusClass = match ($report->status) {
                                                    'Selesai' => 'bg-green-100 text-green-800',
                                                    'On Progress' => 'bg-yellow-100 text-yellow-800',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded-full {{ $statusClass }}">
                                                {{ $report->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3 text-gray-400">
                                                <a href="{{ route('admin.project-reports.edit', $report->id) }}"
                                                    class="hover:text-emerald-600 transition-colors" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.project-reports.destroy', $report->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus laporan ini?');"
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

                        @if($reports->isEmpty())
                            <div class="p-6 text-center text-gray-500">
                                Belum ada laporan yang ditambahkan.
                            </div>
                        @else
                            <div class="p-4">
                                {{ $reports->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>