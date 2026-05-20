<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Jurnal Kegiatan Harian') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="max-w-4xl mx-auto flex flex-col gap-8 pb-10">
            
            <!-- Top: Form Input -->
            @if(auth()->user()->status === 'approved')
            <div class="w-full">
                <div class="content-card relative overflow-hidden bg-white border border-slate-200 rounded-2xl shadow-sm">
                    <!-- Subtle background decoration -->
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-50 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="p-6 relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none">Buat Jurnal</h3>
                                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d M Y') }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </div>
                        </div>
                        
                        <form action="{{ route('intern.journals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            
                            <!-- Activity Description -->
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                    Deskripsi Kegiatan
                                </label>
                                <textarea name="activity" rows="5" 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none shadow-inner" 
                                    required placeholder="Ceritakan apa yang Anda kerjakan, pelajari, atau selesaikan hari ini..."></textarea>
                            </div>
                            
                            <!-- Photo Attachment (Modern Custom File Input) -->
                            <div class="space-y-2">
                                <label class="flex items-center justify-between text-xs font-bold text-slate-700">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                        Lampiran Foto
                                    </div>
                                    <span class="text-[9px] text-slate-400 font-semibold bg-slate-100 px-2 py-0.5 rounded-md uppercase">Opsional</span>
                                </label>
                                
                                <div class="relative group">
                                    <input type="file" name="photo" id="photo_upload" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('file_name').textContent = this.files[0] ? this.files[0].name : 'Pilih atau letakkan foto di sini'">
                                    
                                    <div class="w-full bg-slate-50 border-2 border-dashed border-slate-200 group-hover:border-blue-400 group-hover:bg-blue-50/50 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all duration-300">
                                        <div class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover:text-blue-500 mb-2 shadow-sm transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                        <p id="file_name" class="text-xs font-bold text-slate-600 group-hover:text-blue-700 line-clamp-1 px-2">Pilih atau letakkan foto di sini</p>
                                        <p class="text-[9px] text-slate-400 mt-1">Format: JPG, PNG (Maks 5MB)</p>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-slate-100 my-4">
                            
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-bold text-sm transition-all duration-200 shadow-md shadow-blue-500/20 active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                Kirim Jurnal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Bottom: List Jurnal -->
            <div class="w-full">
                <div class="content-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Riwayat Aktivitas</h3>
                        <a href="{{ route('intern.journals.print') }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-white border border-slate-200 text-slate-600 rounded-lg text-[10px] font-bold hover:bg-slate-50 transition">
                            🖨️ CETAK PDF
                        </a>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        @php
                            $groupedJournals = $journals->groupBy('date');
                        @endphp
                        
                        @forelse($groupedJournals as $date => $dayJournals)
                            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl shadow-sm hover:border-blue-200 transition-all overflow-hidden mb-4 last:mb-0">
                                
                                <!-- Accordion Header (Digital Date) -->
                                <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-5 bg-white hover:bg-slate-50 transition-colors cursor-pointer text-left focus:outline-none">
                                    <div class="flex items-center gap-4 md:gap-6">
                                        <!-- Clean Digital Date Block -->
                                        <div class="flex items-center gap-1.5 text-slate-800">
                                            <span class="text-4xl font-extrabold tracking-tighter">{{ \Carbon\Carbon::parse($date)->format('d') }}</span>
                                            <div class="flex flex-col text-[9px] font-black uppercase tracking-widest leading-none gap-0.5">
                                                <span class="text-blue-600">{{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('F') }}</span>
                                                <span class="text-slate-400">{{ \Carbon\Carbon::parse($date)->format('Y') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                                        
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-tight">{{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('l') }}</h4>
                                            <p class="text-[10px] font-semibold text-slate-400 mt-1 flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                {{ $dayJournals->count() }} Kegiatan
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="w-8 h-8 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180 bg-blue-50 text-blue-600 border-blue-200' : ''">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </span>
                                    </div>
                                </button>
                                
                                <!-- Accordion Content (Timeline) -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200" 
                                     x-transition:enter-start="opacity-0 -translate-y-2" 
                                     x-transition:enter-end="opacity-100 translate-y-0" 
                                     x-transition:leave="transition ease-in duration-150" 
                                     x-transition:leave-start="opacity-100 translate-y-0" 
                                     x-transition:leave-end="opacity-0 -translate-y-2" 
                                     x-cloak 
                                     class="border-t border-slate-100 bg-slate-50/50">
                                     
                                    <div class="p-5 md:p-6 space-y-2">
                                        @foreach($dayJournals as $journal)
                                            <div class="flex gap-4 group/timeline">
                                                <!-- Timeline dot & line -->
                                                <div class="flex flex-col items-center mt-1.5">
                                                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500 ring-4 ring-blue-100 group-hover/timeline:bg-blue-600 transition-colors"></div>
                                                    @if(!$loop->last)
                                                        <div class="flex-1 w-px bg-slate-200 my-1 min-h-[2rem]"></div>
                                                    @endif
                                                </div>
                                                
                                                <!-- Activity Content -->
                                                <div class="flex-1 pb-6 {{ $loop->last ? 'pb-2' : '' }}">
                                                    <div class="flex items-center gap-2 mb-1.5">
                                                        <span class="text-[9px] font-bold text-slate-400 bg-white border border-slate-200 px-2 py-0.5 rounded shadow-sm font-mono tracking-widest uppercase">
                                                            {{ $journal->created_at->format('H:i') }} WIB
                                                        </span>
                                                    </div>
                                                    <p class="text-sm font-medium text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $journal->activity }}</p>
                                                    
                                                    @if($journal->photo_path)
                                                        <div class="mt-3">
                                                            <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank" class="inline-block relative group/img">
                                                                <div class="h-24 w-36 rounded-xl overflow-hidden border border-slate-200 shadow-sm group-hover/img:shadow-md group-hover/img:border-blue-300 transition-all">
                                                                    <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-full h-full object-cover">
                                                                </div>
                                                                <div class="absolute inset-0 bg-blue-900/10 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center rounded-xl">
                                                                    <svg class="w-5 h-5 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 text-slate-300 bg-white border border-slate-100 rounded-2xl">
                                <div class="text-5xl mb-4 opacity-50">🗓️</div>
                                <p class="text-sm font-bold text-slate-500">Belum ada aktivitas yang dicatat.</p>
                                <p class="text-xs text-slate-400 mt-1">Jurnal kegiatan harian Anda akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
