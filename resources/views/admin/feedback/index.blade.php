<x-admin-layout>
    <x-slot name="header">
        Feedback & Pengaduan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Daftar Masukan Warga</h2>

                        <!-- Search & Filter -->
                        <form action="{{ route('admin.feedback.index') }}" method="GET" class="flex gap-2">
                            <!-- Status filter removed -->

                            <select name="month" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Semua Bulan</option>
                                @foreach($months as $month)
                                    <option value="{{ $month->value }}" {{ request('month') == $month->value ? 'selected' : '' }}>
                                        {{ $month->label }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="p-4 font-bold text-slate-700">Nama</th>
                                    <th class="p-4 font-bold text-slate-700">RT / RW</th>
                                    <th class="p-4 font-bold text-slate-700">Telepon</th>
                                    <th class="p-4 font-bold text-slate-700">Deskripsi</th>
                                    <th class="p-4 font-bold text-slate-700">Kategori</th>
                                    <th class="p-4 font-bold text-slate-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($feedback as $item)
                                    <tr
                                        class="border-b border-slate-100 hover:bg-slate-50 transition-colors {{ $item->status == 'baru' ? 'bg-indigo-50/50' : '' }}">
                                        <td class="p-4">
                                            <div class="font-medium text-slate-900">{{ $item->nama }}</div>
                                        </td>
                                        <td class="p-4 text-sm text-slate-600">
                                            @if($item->rt || $item->rw)
                                                RT {{ $item->rt ?? '-' }} / RW {{ $item->rw ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm text-slate-600">{{ $item->telepon ?? '-' }}</td>
                                        <td class="p-4">
                                            <div class="text-sm text-slate-600 line-clamp-2" title="{{ $item->deskripsi }}">
                                                {{ $item->deskripsi }}
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->kategori ?? 'Umum' }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm text-slate-600">
                                            {{ $item->created_at->format('d M Y H:i') }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-slate-500 italic">Belum ada feedback
                                            masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $feedback->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>