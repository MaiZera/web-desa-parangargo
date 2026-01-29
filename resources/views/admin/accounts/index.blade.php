<x-admin-layout>
    <x-slot name="header">
        Pusat Akun & Manajemen Pengguna
    </x-slot>

    <div class="space-y-8 max-w-7xl mx-auto">
        <!-- Dashboard Stats for Accounts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center gap-6">
                <div class="w-16 h-16 bg-emerald-50 rounded-[1.5rem] flex items-center justify-center text-emerald-600 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Akun</p>
                    <h3 class="text-4xl font-black text-slate-900">{{ $users->count() }}</h3>
                </div>
            </div>
            
            <div class="md:col-span-1 lg:col-span-2 bg-emerald-600 p-8 rounded-[2.5rem] shadow-lg shadow-emerald-200/50 flex items-center justify-between text-white relative overflow-hidden">
                <div class="relative z-10 max-w-lg">
                    <h3 class="text-2xl font-black mb-2 tracking-tight">Manajemen Akses Dashboard</h3>
                    <p class="text-emerald-50/80 text-sm font-medium leading-relaxed">Kelola otorisasi administrator untuk menjaga keamanan data dan konten website Desa Parangargo secara efisien.</p>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Daftar Akun (Left) -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-xl font-black text-slate-900">Daftar Akun Terdaftar</h2>
                                <p class="text-slate-400 text-xs font-bold mt-1 uppercase tracking-widest">Manajemen Administrator Desa</p>
                            </div>
                            <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-full text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Updated Today
                            </div>
                        </div>

                        <div class="space-y-6">
                            @foreach($users as $user)
                                <div class="group flex flex-col sm:flex-row items-start sm:items-center justify-between p-6 bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] hover:bg-white hover:border-emerald-200 hover:shadow-2xl hover:shadow-emerald-500/5 transition-all gap-4">
                                    <div class="flex items-center gap-6 min-w-0">
                                        <div class="w-16 h-16 rounded-[1.5rem] bg-white border border-slate-100 flex items-center justify-center text-emerald-600 font-black text-2xl shadow-sm group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-all shrink-0">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center flex-wrap gap-3 mb-1.5">
                                                <h4 class="text-lg font-bold text-slate-900 truncate tracking-tight">{{ $user->name }}</h4>
                                                @if($user->id === auth()->id())
                                                    <span class="text-[9px] bg-emerald-600 text-white px-3 py-1 rounded-full font-black uppercase tracking-wider shrink-0 shadow-lg shadow-emerald-100">Akun Anda</span>
                                                @endif
                                                
                                                <span class="text-[9px] px-3 py-1 rounded-full font-black uppercase tracking-wider shrink-0 shadow-sm 
                                                    {{ $user->access_level === 'super_admin' ? 'bg-indigo-100 text-indigo-600' : ($user->access_level === 'editor' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-600') }}">
                                                    {{ $user->access_level === 'super_admin' ? 'Super Admin' : ($user->access_level === 'editor' ? 'Editor Desa' : 'Administrator') }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.15em] truncate">
                                                <span class="text-slate-300 mr-2">@</span>{{ $user->username }} <span class="mx-2 text-slate-200">|</span> {{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 self-end sm:self-center">
                                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all font-bold text-xs" title="Kelola Profil Saya">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            <span class="hidden md:inline">Edit</span>
                                        </a>
                                        
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center gap-2 px-4 py-3 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all font-bold text-xs" title="Hapus Akun">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    <span class="hidden md:inline">Hapus</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-900 rounded-[2rem] text-white flex items-center gap-6">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-400"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold">Keamanan Akun</h4>
                        <p class="text-sm text-slate-400 leading-relaxed">Berikan akses hanya kepada staf terpercaya. Pastikan kata sandi sulit ditebak.</p>
                    </div>
                </div>
            </div>

            <!-- Add New Account (Right) -->
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col items-center text-center sticky top-8">
                    <div class="w-20 h-20 bg-emerald-50 rounded-[2rem] flex items-center justify-center text-emerald-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Tambah Akun</h3>
                    <p class="text-slate-400 text-sm font-medium mb-8 leading-relaxed">Daftarkan administrator baru untuk membantu mengelola konten desa.</p>
                    <a href="{{ route('admin.accounts.create') }}" class="w-full flex items-center justify-center gap-3 py-5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-emerald-100 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Add New Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
