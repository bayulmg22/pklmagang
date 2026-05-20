<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Peserta') }}
        </h2>
    </x-slot>

    <!-- Custom self-contained styles for unique graph patterns -->
    <style>
        .stripe-bar { background-image: repeating-linear-gradient(45deg, #e2e8f0, #e2e8f0 4px, #cbd5e1 4px, #cbd5e1 8px); }
        .stripe-blue-bar { background-image: repeating-linear-gradient(45deg, #dbeafe, #dbeafe 4px, #93c5fd 4px, #93c5fd 8px); }
    </style>

    @php
        $attendanceCount = \App\Models\Attendance::where('user_id', auth()->id())->count();
        $journalCount = \App\Models\Journal::where('user_id', auth()->id())->count();
        $recentJournals = \App\Models\Journal::where('user_id', auth()->id())->orderBy('date', 'desc')->take(4)->get();
        
        $todayAttendance = \App\Models\Attendance::where('user_id', auth()->id())
            ->where('date', \Carbon\Carbon::today()->toDateString())
            ->first();
    @endphp

    <div class="space-y-6 animate-fade pb-10">
        <!-- Header Row (Donezo Style: Dashboard + Action buttons) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-none">Ringkasan Magang</h1>
                <p class="text-xs font-semibold text-slate-400 mt-2">Selamat datang kembali, pantau progres dan tugas harian Anda.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('intern.attendance') }}" class="flex-1 md:flex-initial flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/10 hover:shadow-blue-500/20 transition-all duration-200 transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Isi Kehadiran
                </a>
                <a href="{{ route('intern.card') }}" class="flex-1 md:flex-initial flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition duration-200 shadow-sm active:scale-95">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm-1.2 5.385a4.125 4.125 0 0 0-1.35-.135c-.482 0-.965.045-1.44.135m5.58 0a4.125 4.125 0 0 1-1.35-.135c-.482 0-.965.045-1.44.135m0 0a2.25 2.25 0 1 0 2.88 0Z" /></svg>
                    ID Card
                </a>
            </div>
        </div>

        @if(auth()->user()->status === 'pending')
            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-3 text-amber-700 shadow-sm">
                <span class="text-xl">⚠️</span>
                <div>
                    <p class="text-sm font-bold">Menunggu Persetujuan Admin</p>
                    <p class="text-xs mt-0.5">Pendaftaran Anda sedang ditinjau. Fitur jurnal dan absensi akan aktif setelah Anda disetujui.</p>
                </div>
            </div>
        @endif

        <!-- Metrics Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Profil & Status -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 text-white relative overflow-hidden shadow-lg shadow-blue-500/10 group transition duration-300 hover:-translate-y-1">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
                <div class="flex justify-between items-start relative z-10">
                    <span class="text-xs font-bold text-blue-100/90 tracking-wide uppercase">Profil Peserta</span>
                    <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-white text-xs border border-white/20 transition-transform group-hover:scale-110">👤</span>
                </div>
                <h3 class="text-xl font-extrabold tracking-tight mt-4 leading-none truncate relative z-10">{{ auth()->user()->name }}</h3>
                <p class="text-[10px] text-blue-200 font-bold mt-1 uppercase tracking-widest relative z-10">{{ auth()->user()->nim }}</p>
                
                <div class="mt-4 flex items-center gap-1.5 bg-white/10 border border-white/10 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit relative z-10">
                    @if(auth()->user()->status === 'approved')
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span>Status: Aktif</span>
                    @elseif(auth()->user()->status === 'pending')
                        <span class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse"></span>
                        <span>Status: Pending</span>
                    @else
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span>Status: Selesai</span>
                    @endif
                </div>
            </div>

            <!-- Card 2: Total Kehadiran -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Total Kehadiran</span>
                    <span class="w-7 h-7 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-xs transition-transform group-hover:scale-110">📋</span>
                </div>
                <h3 class="text-4xl font-extrabold text-slate-800 tracking-tight mt-4 leading-none">{{ $attendanceCount }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-emerald-50 border border-emerald-100/50 text-emerald-700 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>✓</span>
                    <span>Hari tercatat</span>
                </div>
            </div>

            <!-- Card 3: Total Jurnal -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Jurnal Harian</span>
                    <span class="w-7 h-7 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 text-xs transition-transform group-hover:scale-110">📝</span>
                </div>
                <h3 class="text-4xl font-extrabold text-slate-800 tracking-tight mt-4 leading-none">{{ $journalCount }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-indigo-50 border border-indigo-100/50 text-indigo-700 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>📈</span>
                    <span>Laporan dikirim</span>
                </div>
            </div>

            <!-- Card 4: Asal Instansi -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Asal Instansi</span>
                    <span class="w-7 h-7 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 text-xs transition-transform group-hover:scale-110">🏫</span>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mt-4 leading-tight line-clamp-2 h-10">{{ auth()->user()->school }}</h3>
                <div class="mt-2.5 flex items-center gap-1.5 bg-slate-50 border border-slate-100/50 text-slate-600 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>🎓</span>
                    <span>Peserta Magang</span>
                </div>
            </div>
        </div>

        <!-- Middle Row (Activity, Status Hari Ini, Jurnal Terbaru) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Column 1: Status Hari Ini (width: 4/12) -->
            <div class="content-card p-6 lg:col-span-4 flex flex-col bg-slate-950 text-white relative overflow-hidden group">
                <!-- Glowing abstract grid waves in background -->
                <div class="absolute -right-10 -bottom-10 w-36 h-36 rounded-full bg-blue-500/10 blur-2xl pointer-events-none transition duration-500 group-hover:bg-blue-500/20"></div>
                
                <div class="relative z-10 flex-1 flex flex-col">
                    <h3 class="text-xs font-bold text-slate-400 tracking-wider uppercase leading-none">Absensi Hari Ini</h3>
                    <p class="text-[10px] text-blue-400 font-semibold mt-1">{{ \Carbon\Carbon::today()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                    
                    <div class="mt-8 flex-1 flex flex-col justify-center gap-4">
                        @if($todayAttendance)
                            <div class="bg-white/10 border border-white/10 rounded-xl p-4 flex items-center gap-4 backdrop-blur-sm">
                                <div class="w-10 h-10 rounded-full {{ $todayAttendance->status == 'hadir' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }} flex items-center justify-center text-lg shadow-inner">
                                    {{ $todayAttendance->status == 'hadir' ? '✅' : 'ℹ️' }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-300">Status Kehadiran</p>
                                    <p class="text-lg font-black text-white capitalize">{{ $todayAttendance->status == 'hadir' ? 'Hadir' : $todayAttendance->status }}</p>
                                </div>
                            </div>
                            
                            @if($todayAttendance->check_in_time)
                            <div class="flex justify-between items-center text-xs font-semibold bg-slate-900/50 p-3 rounded-lg border border-white/5">
                                <span class="text-slate-400 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Jam Masuk</span>
                                <span class="text-emerald-400">{{ \Carbon\Carbon::parse($todayAttendance->check_in_time)->format('H:i') }} WIB</span>
                            </div>
                            @endif
                            
                            @if($todayAttendance->check_out_time)
                            <div class="flex justify-between items-center text-xs font-semibold bg-slate-900/50 p-3 rounded-lg border border-white/5 mt-1">
                                <span class="text-slate-400 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Jam Pulang</span>
                                <span class="text-amber-400">{{ \Carbon\Carbon::parse($todayAttendance->check_out_time)->format('H:i') }} WIB</span>
                            </div>
                            @endif
                        @else
                            <div class="text-center py-6">
                                <span class="text-4xl drop-shadow-md">⏱️</span>
                                <p class="text-sm font-bold text-slate-300 mt-4">Belum Absen Hari Ini</p>
                                <p class="text-[10px] text-slate-500 mt-1">Jangan lupa scan QR code di kantor.</p>
                                @if(auth()->user()->status === 'approved')
                                    <a href="{{ route('intern.attendance') }}" class="inline-block mt-4 text-[10px] font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition active:scale-95 shadow-lg shadow-blue-900/50 uppercase tracking-wider">Izin / Sakit?</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Column 2: Checklist & Tindakan (width: 4/12) -->
            <div class="content-card p-6 lg:col-span-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 leading-none">Tugas Harian</h3>
                    <p class="text-[10px] text-slate-400 font-semibold mt-1">Daftar aktivitas wajib selama magang.</p>
                </div>
                
                <div class="space-y-4 mt-6">
                    <a href="{{ route('intern.attendance') }}" class="flex items-center justify-between group/btn p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xs shadow-sm border border-emerald-100">1</div>
                            <div>
                                <p class="text-xs font-bold text-slate-700 group-hover/btn:text-blue-700 transition-colors">Isi Kehadiran</p>
                                <p class="text-[9px] text-slate-400 font-semibold">Wajib dilakukan setiap pagi.</p>
                            </div>
                        </div>
                        <span class="text-slate-300 group-hover/btn:text-blue-500 transition-transform group-hover/btn:translate-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </span>
                    </a>
                    
                    <a href="{{ route('intern.journals') }}" class="flex items-center justify-between group/btn p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xs shadow-sm border border-indigo-100">2</div>
                            <div>
                                <p class="text-xs font-bold text-slate-700 group-hover/btn:text-blue-700 transition-colors">Tulis Jurnal</p>
                                <p class="text-[9px] text-slate-400 font-semibold">Dokumentasikan kegiatan harian.</p>
                            </div>
                        </div>
                        <span class="text-slate-300 group-hover/btn:text-blue-500 transition-transform group-hover/btn:translate-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </span>
                    </a>
                    
                    <a href="{{ route('intern.evaluation') }}" class="flex items-center justify-between group/btn p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xs shadow-sm border border-amber-100">3</div>
                            <div>
                                <p class="text-xs font-bold text-slate-700 group-hover/btn:text-blue-700 transition-colors">Cek Penilaian</p>
                                <p class="text-[9px] text-slate-400 font-semibold">Lihat nilai di akhir magang.</p>
                            </div>
                        </div>
                        <span class="text-slate-300 group-hover/btn:text-blue-500 transition-transform group-hover/btn:translate-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Column 3: Jurnal Terbaru (width: 4/12) -->
            <div class="content-card p-6 lg:col-span-4 flex flex-col justify-between">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-none">Jurnal Terbaru</h3>
                        <p class="text-[10px] text-slate-400 font-semibold mt-1">Aktivitas terakhir yang dilaporkan.</p>
                    </div>
                    <a href="{{ route('intern.journals') }}" class="text-[9px] font-extrabold text-blue-600 hover:text-blue-700 bg-blue-50 px-2 py-1 rounded-lg border border-blue-100 transition shadow-sm">
                        Lihat Semua
                    </a>
                </div>
                
                <div class="space-y-4 mt-6 flex-1">
                    @forelse($recentJournals as $journal)
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-3 last:border-0 last:pb-0 hover:bg-slate-50/50 rounded-lg transition p-1 -mx-1">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-xs shrink-0 overflow-hidden shadow-sm">
                                @if($journal->photo_path)
                                    <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-full h-full object-cover">
                                @else
                                    📝
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold text-slate-700 truncate leading-none">{{ $journal->activity }}</p>
                                <p class="text-[9px] text-slate-400 font-semibold mt-1.5 leading-none">{{ \Carbon\Carbon::parse($journal->date)->locale('id')->isoFormat('D MMM YYYY') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full py-6 text-center">
                            <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center text-slate-300 text-xl mb-3 shadow-sm">📋</div>
                            <p class="text-xs font-bold text-slate-500">Belum ada jurnal</p>
                            <p class="text-[10px] text-slate-400 mt-1 font-semibold">Anda belum menulis jurnal harian.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
        </div>

        <!-- Footer Banner -->
        <x-footer-banner />
    </div>
</x-app-layout>
