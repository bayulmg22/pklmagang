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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Form Input -->
            @if(auth()->user()->status === 'approved')
            <div class="lg:col-span-4">
                <div class="content-card p-6 sticky top-24">
                    <h3 class="font-bold text-slate-800 mb-2">Input Aktivitas</h3>
                    <p class="text-xs text-slate-400 mb-6 uppercase tracking-widest font-bold">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    
                    <form action="{{ route('intern.journals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Kegiatan</label>
                            <textarea name="activity" rows="5" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" 
                                required placeholder="Tuliskan apa yang Anda kerjakan hari ini..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Lampiran Foto <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="file" name="photo" accept="image/*" 
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 transition cursor-pointer border border-slate-200 rounded-xl p-1 bg-slate-50">
                        </div>
                        <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg active:translate-y-0.5">
                            SIMPAN JURNAL
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Right: List Jurnal -->
            <div class="{{ auth()->user()->status === 'approved' ? 'lg:col-span-8' : 'lg:col-span-12' }}">
                <div class="content-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Riwayat Aktivitas</h3>
                        <a href="{{ route('intern.journals.print') }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-white border border-slate-200 text-slate-600 rounded-lg text-[10px] font-bold hover:bg-slate-50 transition">
                            🖨️ CETAK PDF
                        </a>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        @forelse($journals as $journal)
                            <div class="group flex gap-6 p-5 bg-white border border-slate-100 rounded-2xl hover:border-blue-100 hover:shadow-sm transition-all">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-400 border border-slate-100 flex flex-col items-center justify-center font-bold group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition-colors">
                                        <span class="text-xs uppercase leading-none mb-1 text-[8px] tracking-widest">{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('M') }}</span>
                                        <span class="text-lg leading-none">{{ \Carbon\Carbon::parse($journal->date)->format('d') }}</span>
                                    </div>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-sm font-bold text-slate-800 uppercase tracking-tight">{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('l, d F Y') }}</h4>
                                        <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-full">{{ $journal->created_at->format('H:i') }} WIB</span>
                                    </div>
                                    <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-wrap">{{ $journal->activity }}</p>
                                    
                                    @if($journal->photo_path)
                                        <div class="mt-4">
                                            <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank" class="inline-block relative group/img">
                                                <div class="h-32 w-48 rounded-xl overflow-hidden border border-slate-100 group-hover/img:shadow-md transition-all">
                                                    <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-full h-full object-cover">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 text-slate-300">
                                <div class="text-5xl mb-4 opacity-50">📝</div>
                                <p class="text-sm font-medium">Belum ada aktivitas yang Anda catat hari ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
