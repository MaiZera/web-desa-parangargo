<x-admin-layout>
    <x-slot name="header">
        Kelola UMKM Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Daftar UMKM</h2>
                        <a href="{{ route('admin.umkm.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                             + Tambah UMKM
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
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
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $umkm->kategori }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm text-slate-600">
                                            <div>{{ Str::limit($umkm->alamat, 30) }}</div>
                                            <div class="text-slate-400 mt-1">{{ $umkm->telepon ?? '-' }}</div>
                                        </td>
                                        <td class="p-4">
                                            @if($umkm->is_active)
                                                <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">Aktif</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="{{ route('admin.umkm.edit', $umkm) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                                            <form action="{{ route('admin.umkm.destroy', $umkm) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase" onclick="return confirm('Hapus UMKM ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-slate-500 italic">Belum ada UMKM terdaftar.</td>
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
</x-admin-layout>
