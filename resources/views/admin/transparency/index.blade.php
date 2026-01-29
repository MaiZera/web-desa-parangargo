<x-admin-layout>
    <x-slot name="header">
        Transparansi APBD
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">Daftar Banner APBD</h2>
                        <a href="{{ route('admin.transparency.create') }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
                            + Tambah Banner
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-4 font-semibold text-gray-600">No</th>
                                    <th class="p-4 font-semibold text-gray-600">Banner</th>
                                    <th class="p-4 font-semibold text-gray-600">Judul</th>
                                    <th class="p-4 font-semibold text-gray-600">Tanggal Upload</th>
                                    <th class="p-4 font-semibold text-gray-600 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($transparencies as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4">{{ $index + 1 }}</td>
                                        <td class="p-4">
                                            <div class="w-32 h-20 bg-gray-200 rounded-lg overflow-hidden bg-cover bg-center border border-gray-200"
                                                style="background-image: url('{{ asset('storage/' . $item->image) }}')">
                                            </div>
                                        </td>
                                        <td class="p-4 font-medium">{{ $item->title }}</td>
                                        <td class="p-4 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="p-4 text-right">
                                            <form action="{{ route('admin.transparency.destroy', $item->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus banner ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-gray-500">
                                            Belum ada data banner APBD.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
