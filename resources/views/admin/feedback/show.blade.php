<x-admin-layout>
    <x-slot name="header">
        Detail Feedback
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-8">
                    <div class="flex justify-between items-center border-b pb-4">
                        <h2 class="text-2xl font-bold text-slate-800">Detail Aspirasi</h2>
                        <a href="{{ route('admin.feedback.index') }}"
                            class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                            &larr; Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Informasi
                                    Pengirim</h3>
                                <div class="bg-slate-50 p-4 rounded-xl space-y-3">
                                    <div>
                                        <label class="text-xs text-slate-500 block">Nama Lengkap</label>
                                        <p class="font-medium text-slate-900">{{ $feedback->nama }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-xs text-slate-500 block">RT / RW</label>
                                            <p class="font-medium text-slate-900">RT {{ $feedback->rt ?? '-' }} / RW
                                                {{ $feedback->rw ?? '-' }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="text-xs text-slate-500 block">Telepon</label>
                                            <p class="font-medium text-slate-900">{{ $feedback->telepon ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Detail
                                    Aspirasi</h3>
                                <div class="bg-slate-50 p-4 rounded-xl space-y-3">
                                    <div>
                                        <label class="text-xs text-slate-500 block">Kategori</label>
                                        <span
                                            class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 mt-1">
                                            {{ $feedback->kategori ?? 'Umum' }}
                                        </span>
                                    </div>
                                    <div>
                                        <label class="text-xs text-slate-500 block">Tanggal Masuk</label>
                                        <p class="font-medium text-slate-900">
                                            {{ $feedback->created_at->format('d M Y, H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Pesan /
                                    Masukan</h3>
                                <div
                                    class="bg-slate-50 p-6 rounded-xl min-h-[120px] text-slate-800 leading-relaxed whitespace-pre-wrap">
                                    {{ $feedback->deskripsi }}
                                </div>
                            </div>

                            @if($feedback->lampiran)
                                <div>
                                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Lampiran Foto
                                    </h3>
                                    <div class="bg-slate-50 p-2 rounded-xl border border-slate-200 inline-block">
                                        <a href="{{ asset('storage/' . $feedback->lampiran) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $feedback->lampiran) }}" alt="Lampiran Feedback"
                                                class="max-w-full h-auto rounded-lg max-h-[400px] object-contain hover:opacity-95 transition-opacity">
                                        </a>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1 italic">Klik gambar untuk memperbesar</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>