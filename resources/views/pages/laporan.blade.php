@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-16">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-8 bg-white p-12 rounded-[3rem] shadow-sm border border-slate-100">
        <div class="max-w-2xl space-y-4 text-center md:text-left">
            <h1 class="text-4xl font-bold text-slate-900">Laporan Kegiatan Desa</h1>
            <p class="text-lg text-slate-600 leading-relaxed">Transparansi dalam setiap gerak langkah pembangunan. Temukan laporan detail mengenai penggunaan dana dan realisasi program desa di sini.</p>
            
            <!-- Search Form -->
            <form action="{{ route('news.laporan') }}" method="GET" class="pt-4 w-full md:w-auto">
                <div class="relative max-w-lg">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari laporan kegiatan..." 
                           class="w-full pl-12 pr-4 py-3 rounded-full border border-slate-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="p-6 bg-blue-50 rounded-3xl text-center">
                <p class="text-3xl font-bold text-blue-600">{{ \App\Models\ProjectReport::where('status', 'Selesai')->count() }}</p>
                <p class="text-xs font-bold text-blue-400 uppercase tracking-tighter mt-1">Program Selesai</p>
            </div>
            <div class="p-6 bg-emerald-50 rounded-3xl text-center">
                <p class="text-3xl font-bold text-emerald-600">{{ number_format(\App\Models\ProjectReport::avg('percentage'), 0) }}%</p>
                <p class="text-xs font-bold text-emerald-400 uppercase tracking-tighter mt-1">Rata-rata Progress</p>
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($reports as $report)
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group relative cursor-pointer" onclick="openModal('{{ $report->id }}')">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-slate-50 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4h4"/></svg>
                    </div>
                    @php
                        $statusClass = match($report->status) {
                            'Selesai' => 'bg-emerald-100 text-emerald-700',
                            'On Progress' => 'bg-amber-100 text-amber-700',
                            default => 'bg-slate-100 text-slate-700',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClass }}">{{ $report->status }}</span>
                </div>
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">{{ $report->created_at->translatedFormat('F Y') }}</p>
                <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $report->title }}</h3>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed line-clamp-3">{{ $report->description }}</p>
                
                <div class="flex gap-2 text-xs font-bold text-slate-400 mb-4">
                    @if($report->rt)<span class="bg-slate-50 px-2 py-1 rounded">RT {{ $report->rt }}</span>@endif
                    @if($report->rw)<span class="bg-slate-50 px-2 py-1 rounded">RW {{ $report->rw }}</span>@endif
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-400">Realisasi Program</span>
                        <span class="text-emerald-600">{{ $report->percentage }}%</span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $report->percentage }}%"></div>
                    </div>
                </div>

                <!-- Hidden Data for Modal -->
                <div id="data-{{ $report->id }}" class="hidden">
                    <div class="modal-title">{{ $report->title }}</div>
                    <div class="modal-location">{{ $report->location }}</div>
                    <div class="modal-rt">{{ $report->rt }}</div>
                    <div class="modal-rw">{{ $report->rw }}</div>
                    <div class="modal-description">{{ nl2br(e($report->description)) }}</div>
                    <div class="modal-status">{{ $report->status }}</div>
                    <div class="modal-percentage">{{ $report->percentage }}</div>
                    <div class="modal-fund">{{ $report->fund_usage_formatted }}</div>
                    <div class="modal-image">{{ $report->image ? asset('storage/' . $report->image) : '' }}</div>
                    <div class="modal-date">{{ $report->created_at->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-500">
                <p>Belum ada laporan kegiatan yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $reports->links() }}
    </div>
</div>

<!-- Modal Popup -->
<div id="reportModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold leading-6 text-gray-900" id="modalTitle"></h3>
                            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <div id="modalImageContainer" class="mb-6 hidden">
                            <img id="modalImage" src="" alt="Foto Proyek" class="w-full h-64 object-cover rounded-xl">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div class="bg-slate-50 p-4 rounded-xl">
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-1">Lokasi</p>
                                <p class="font-semibold text-gray-900" id="modalLocation"></p>
                                <p class="text-gray-600 text-xs mt-1">RT <span id="modalRT"></span> / RW <span id="modalRW"></span></p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl">
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-1">Penggunaan Dana</p>
                                <p class="font-semibold text-emerald-600 text-lg" id="modalFund"></p>
                            </div>
                        </div>

                        <div class="prose prose-sm max-w-none text-gray-500 mb-6" id="modalDescription"></div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-slate-500">Status: <span id="modalStatus" class="text-emerald-600"></span></span>
                                <span class="text-emerald-600"><span id="modalPercentage"></span>% Resolved</span>
                            </div>
                            <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                                <div id="modalProgressBar" class="h-full bg-emerald-500 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const dataDiv = document.getElementById('data-' + id);
        
        document.getElementById('modalTitle').innerText = dataDiv.querySelector('.modal-title').innerText;
        document.getElementById('modalLocation').innerText = dataDiv.querySelector('.modal-location').innerText;
        document.getElementById('modalRT').innerText = dataDiv.querySelector('.modal-rt').innerText;
        document.getElementById('modalRW').innerText = dataDiv.querySelector('.modal-rw').innerText;
        document.getElementById('modalDescription').innerHTML = dataDiv.querySelector('.modal-description').innerHTML; // Use innerHTML for formatting
        document.getElementById('modalStatus').innerText = dataDiv.querySelector('.modal-status').innerText;
        document.getElementById('modalPercentage').innerText = dataDiv.querySelector('.modal-percentage').innerText;
        document.getElementById('modalFund').innerText = dataDiv.querySelector('.modal-fund').innerText;
        
        const imageUrl = dataDiv.querySelector('.modal-image').innerText;
        const imgContainer = document.getElementById('modalImageContainer');
        const img = document.getElementById('modalImage');
        
        if (imageUrl) {
            img.src = imageUrl;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
        }

        const percentage = dataDiv.querySelector('.modal-percentage').innerText;
        document.getElementById('modalProgressBar').style.width = percentage + '%';

        document.getElementById('reportModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeModal() {
        document.getElementById('reportModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>
@endsection
