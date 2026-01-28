<x-admin-layout>
    <x-slot name="header">
        Kelola Agenda Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Daftar Agenda</h2>
                        <a href="{{ route('admin.agendas.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                             + Tambah Agenda
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
                                            <span class="text-xs text-slate-500">{{ $agenda->tanggal_mulai->format('H:i') }}</span>
                                        </td>
                                        <td class="p-4 font-medium">{{ $agenda->judul }}</td>
                                        <td class="p-4 text-slate-600">{{ $agenda->lokasi ?? '-' }}</td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 rounded-full text-xs font-bold uppercase
                                                @if($agenda->status == 'scheduled') bg-blue-100 text-blue-700 
                                                @elseif($agenda->status == 'ongoing') bg-amber-100 text-amber-700 
                                                @elseif($agenda->status == 'completed') bg-emerald-100 text-emerald-700 
                                                @else bg-gray-100 text-gray-700 @endif
                                            ">
                                                {{ ucfirst($agenda->status) }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="{{ route('admin.agendas.edit', $agenda) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                                            <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase" onclick="return confirm('Hapus agenda ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-slate-500 italic">Belum ada agenda terdaftar.</td>
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
</x-admin-layout>
