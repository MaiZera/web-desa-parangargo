<x-admin-layout>
    <x-slot name="header">
        Staff Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Daftar Staff Desa</h2>
                        <a href="{{ route('admin.staff.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition-colors">
                            + Tambah Staff
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
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Nama & Jabatan</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($staff as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-20 h-20 rounded-lg object-cover shrink-0">
                                            @else
                                                <div class="w-20 h-20 rounded-lg bg-gray-200 flex items-center justify-center shrink-0">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $item->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $item->jabatan }}</div>
                                                @if($item->nip)
                                                    <div class="text-xs text-gray-400">NIP: {{ $item->nip }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        @if($item->telepon)
                                            <div>📞 {{ $item->telepon }}</div>
                                        @endif
                                        @if($item->email)
                                            <div>✉️ {{ $item->email }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-3 text-gray-400">
                                            <a href="{{ route('admin.staff.edit', $item->id) }}" class="hover:text-emerald-600 transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('admin.staff.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus staff ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:text-red-600 transition-colors" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @if($staff->isEmpty())
                            <div class="p-6 text-center text-gray-500">
                                Belum ada staff yang ditambahkan.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
