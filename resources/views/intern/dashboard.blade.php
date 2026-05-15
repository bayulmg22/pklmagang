<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Ringkasan Akun') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Profile Header Card -->
        <div class="content-card p-4 sm:p-6 flex flex-col md:flex-row items-center gap-4 sm:gap-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-full bg-slate-50 -skew-x-12 transform translate-x-16 opacity-50"></div>
            
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-slate-100 border-4 border-white shadow-sm overflow-hidden flex-shrink-0 relative z-10">
                @if(auth()->user()->photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-3xl sm:text-4xl text-slate-300">👤</div>
                @endif
            </div>
            
            <div class="flex-1 text-center md:text-left relative z-10 space-y-1">
                <h3 class="text-lg sm:text-2xl font-black text-slate-800 leading-tight">{{ auth()->user()->name }}</h3>
                <p class="text-blue-600 font-bold text-[10px] sm:text-sm tracking-widest uppercase">{{ auth()->user()->nim }}</p>
                <div class="pt-1 flex flex-col md:flex-row items-center md:justify-start gap-2">
                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[8px] sm:text-[10px] font-black uppercase border border-slate-200">{{ auth()->user()->school }}</span>
                    @if(auth()->user()->status === 'approved')
                        <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-[8px] sm:text-[10px] font-black uppercase border border-emerald-100">Status: Aktif</span>
                    @elseif(auth()->user()->status === 'pending')
                        <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-600 text-[8px] sm:text-[10px] font-black uppercase border border-amber-100">Status: Menunggu ACC</span>
                    @else
                        <span class="px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-600 text-[8px] sm:text-[10px] font-black uppercase border border-indigo-100">Status: Selesai</span>
                    @endif
                </div>
            </div>
        </div>

        @if(auth()->user()->status === 'pending')
            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-3 text-amber-700">
                <span class="text-xl">⚠️</span>
                <p class="text-sm">Pendaftaran Anda sedang ditinjau. Beberapa fitur akan aktif setelah Anda disetujui oleh Admin.</p>
            </div>
        @endif

        <!-- Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- ID Card -->
            <div class="content-card p-6 flex flex-col h-full">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-4 shadow-sm border border-blue-100">🪪</div>
                <h4 class="font-bold text-slate-800 mb-2">ID Card Magang</h4>
                <p class="text-sm text-slate-500 mb-6 flex-1">Gunakan kartu identitas digital untuk keperluan scan absensi di kantor.</p>
                <a href="{{ route('intern.card') }}" class="w-full py-2.5 text-center bg-slate-900 text-white rounded-lg text-sm font-bold hover:bg-slate-800 transition">Buka ID Card</a>
            </div>

            <!-- Absensi -->
            <div class="content-card p-6 flex flex-col h-full">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-4 shadow-sm border border-emerald-100">📋</div>
                <h4 class="font-bold text-slate-800 mb-2">Absensi Harian</h4>
                <p class="text-sm text-slate-500 mb-6 flex-1">Laporkan sakit atau izin jika Anda berhalangan hadir magang hari ini.</p>
                @if(auth()->user()->status === 'approved')
                    <a href="{{ route('intern.attendance') }}" class="w-full py-2.5 text-center bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition">Isi Kehadiran</a>
                @else
                    <button disabled class="w-full py-2.5 text-center bg-slate-100 text-slate-400 rounded-lg text-sm font-bold cursor-not-allowed italic">Menunggu Persetujuan</button>
                @endif
            </div>

            <!-- Jurnal -->
            <div class="content-card p-6 flex flex-col h-full">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl mb-4 shadow-sm border border-indigo-100">📝</div>
                <h4 class="font-bold text-slate-800 mb-2">Jurnal Kegiatan</h4>
                <p class="text-sm text-slate-500 mb-6 flex-1">Dokumentasikan kegiatan harian Anda selama masa magang berlangsung.</p>
                @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                    <a href="{{ route('intern.journals') }}" class="w-full py-2.5 text-center bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition">Input Jurnal</a>
                @else
                    <button disabled class="w-full py-2.5 text-center bg-slate-100 text-slate-400 rounded-lg text-sm font-bold cursor-not-allowed italic">Menunggu Persetujuan</button>
                @endif
            </div>
        </div>

        <!-- Footer Banner -->
        <x-footer-banner />
    </div>
</x-app-layout>
