<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Custom self-contained styles for unique graph patterns -->
    <style>
        .stripe-bar {
            background-image: repeating-linear-gradient(45deg, #e2e8f0, #e2e8f0 4px, #cbd5e1 4px, #cbd5e1 8px);
        }
        .stripe-blue-bar {
            background-image: repeating-linear-gradient(45deg, #dbeafe, #dbeafe 4px, #93c5fd 4px, #93c5fd 8px);
        }
    </style>

    <div class="space-y-6 animate-fade pb-10">
        <!-- Header Row (Donezo Style: Dashboard + Action buttons) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-none">Dashboard</h1>
                <p class="text-xs font-semibold text-slate-400 mt-2">Monitor, kelola, dan tingkatkan kompetensi peserta magang Dinsos.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('admin.interns') }}" class="flex-1 md:flex-initial flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/10 hover:shadow-blue-500/20 transition-all duration-200 transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Peserta
                </a>
                <button class="flex-1 md:flex-initial flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition duration-200 shadow-sm active:scale-95">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                    Ekspor Excel
                </button>
            </div>
        </div>

        <!-- Metrics Row (Donezo Style: 4 cards with arrow badges) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Pendaftar (Donezo Green Card -> Royal Blue) -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-5 text-white relative overflow-hidden shadow-lg shadow-blue-500/10 group hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-blue-100/90 tracking-wide uppercase">Total Pendaftar</span>
                    <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-white text-xs border border-white/20 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                </div>
                <h3 class="text-4xl font-extrabold tracking-tight mt-4 leading-none">{{ $stats['total_interns'] }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-white/10 border border-white/10 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>📈</span>
                    <span>Meningkat dari bulan lalu</span>
                </div>
            </div>

            <!-- Card 2: Menunggu ACC -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Menunggu ACC</span>
                    <span class="w-7 h-7 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-blue-600 text-xs transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                </div>
                <h3 class="text-4xl font-extrabold text-slate-800 tracking-tight mt-4 leading-none">{{ $stats['pending'] }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-amber-50 border border-amber-100/50 text-amber-700 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>🕒</span>
                    <span>Menanti verifikasi berkas</span>
                </div>
            </div>

            <!-- Card 3: Peserta Aktif -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Peserta Aktif</span>
                    <span class="w-7 h-7 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-blue-600 text-xs transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                </div>
                <h3 class="text-4xl font-extrabold text-slate-800 tracking-tight mt-4 leading-none">{{ $stats['active'] }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-emerald-50 border border-emerald-100/50 text-emerald-700 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>✓</span>
                    <span>Sedang menjalani magang</span>
                </div>
            </div>

            <!-- Card 4: Alumni Selesai -->
            <div class="bg-white border border-slate-200/60 rounded-2xl p-5 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300 group hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-slate-400 tracking-wide uppercase">Alumni Selesai</span>
                    <span class="w-7 h-7 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-blue-600 text-xs transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">↗</span>
                </div>
                <h3 class="text-4xl font-extrabold text-slate-800 tracking-tight mt-4 leading-none">{{ $stats['alumni'] }}</h3>
                <div class="mt-4 flex items-center gap-1.5 bg-indigo-50 border border-indigo-100/50 text-indigo-700 rounded-full px-2.5 py-1 text-[9px] font-bold w-fit">
                    <span>🎓</span>
                    <span>Telah menyelesaikan program</span>
                </div>
            </div>
        </div>

        <!-- Middle Row (Donezo: Weekly Project Analytics, Reminders, Project Checklist) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Column 1: Project Analytics (Chart width: 5/12) -->
            <div class="content-card p-6 lg:col-span-5 flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 leading-none">Analisis Aktivitas</h3>
                    <p class="text-[10px] text-slate-400 font-semibold mt-1">Distribusi kehadiran mingguan peserta magang.</p>
                </div>
                
                <!-- Vertical Capsule Chart -->
                <div class="flex justify-between items-end h-40 mt-6 px-2 relative">
                    <!-- Day S -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-24 rounded-full bg-slate-100 stripe-bar relative group"></div>
                        <span class="text-[10px] font-bold text-slate-400">S</span>
                    </div>
                    <!-- Day M -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-36 rounded-full bg-blue-600 relative group">
                            <span class="absolute -top-7 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[8px] font-bold rounded px-1.5 py-0.5 opacity-0 group-hover:opacity-100 transition duration-200 shadow-sm leading-none pointer-events-none">82%</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400">M</span>
                    </div>
                    <!-- Day T -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-28 rounded-full bg-blue-400/70 relative group">
                            <span class="absolute -top-7 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[8px] font-bold rounded px-1.5 py-0.5 opacity-0 group-hover:opacity-100 transition duration-200 shadow-sm leading-none pointer-events-none">64%</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400">T</span>
                    </div>
                    <!-- Day W -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <!-- Floating Wednesday bubble showing 92% just like Donezo -->
                        <div class="w-6 h-40 rounded-full bg-indigo-900 relative group">
                            <span class="absolute -top-7 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[8px] font-black rounded-full px-2 py-1 shadow-sm leading-none flex items-center justify-center border border-blue-500">92%</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400">W</span>
                    </div>
                    <!-- Day T -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-32 rounded-full bg-slate-100 stripe-blue-bar relative group"></div>
                        <span class="text-[10px] font-bold text-slate-400">T</span>
                    </div>
                    <!-- Day F -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-20 rounded-full bg-blue-400/40 relative group"></div>
                        <span class="text-[10px] font-bold text-slate-400">F</span>
                    </div>
                    <!-- Day S -->
                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="w-6 h-12 rounded-full bg-slate-100 stripe-bar relative group"></div>
                        <span class="text-[10px] font-bold text-slate-400">S</span>
                    </div>
                </div>
            </div>

            <!-- Column 2: Reminders Meeting Box (width: 3/12) -->
            <div class="content-card p-6 lg:col-span-3 flex flex-col justify-between bg-slate-50/50">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 leading-none">Reminder</h3>
                    <p class="text-[10px] text-slate-400 font-semibold mt-1">Agenda rapat koordinasi terdekat.</p>
                </div>
                
                <div class="space-y-4 my-6">
                    <h4 class="text-base font-extrabold text-slate-800 leading-snug">Rapat Pembekalan Evaluasi Bulanan Dinsos</h4>
                    <div class="flex items-center gap-2 text-[10px] text-slate-500 font-semibold bg-white border border-slate-200/60 rounded-lg p-2.5 shadow-sm">
                        <span>⏰</span>
                        <span>09:00 WIB - 11:30 WIB</span>
                    </div>
                </div>

                <a href="#" class="w-full flex items-center justify-center gap-2 py-3 px-4 text-xs font-black text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition duration-200 shadow-md shadow-blue-500/10 active:scale-95 uppercase tracking-wider">
                    <span>📹</span>
                    Gabung Rapat
                </a>
            </div>

            <!-- Column 3: Checklist (width: 4/12) -->
            <div class="content-card p-6 lg:col-span-4 flex flex-col justify-between">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-none">Tugas Operasional</h3>
                        <p class="text-[10px] text-slate-400 font-semibold mt-1">Daftar ceklist harian sistem.</p>
                    </div>
                    <button class="text-[9px] font-extrabold text-blue-600 hover:text-blue-700 bg-blue-50 px-2 py-1 rounded-lg border border-blue-100">
                        + Baru
                    </button>
                </div>

                <div class="space-y-3 mt-5">
                    @php
                        $todos = [
                            ['Verifikasi Berkas Pendaftar', '24 Mei 2026', 'bg-blue-100 text-blue-600', '📁'],
                            ['Review Jurnal Harian Peserta', '25 Mei 2026', 'bg-emerald-100 text-emerald-600', '📝'],
                            ['Input Penilaian Kompetensi', '28 Mei 2026', 'bg-amber-100 text-amber-600', '⭐'],
                            ['Cetak Kartu Tanda Pengenal', '30 Mei 2026', 'bg-indigo-100 text-indigo-600', '🪪']
                        ];
                    @endphp
                    @foreach($todos as $todo)
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2.5 last:border-0 last:pb-0">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="w-7 h-7 rounded-lg {{ $todo[2] }} flex items-center justify-center text-xs shrink-0 font-bold">
                                {{ $todo[3] }}
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-700 truncate">{{ $todo[0] }}</p>
                                <p class="text-[9px] text-slate-400 font-semibold mt-0.5">Batas: {{ $todo[1] }}</p>
                            </div>
                        </div>
                        <input type="checkbox" class="w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500/20 cursor-pointer">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Row (Donezo: Team Collaboration, Project Progress Gauge, Time Tracker Clock) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Column 1: Team Collaboration (width: 5/12) -->
            <div class="content-card p-6 lg:col-span-5 flex flex-col justify-between">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-none">Peserta Terbaru</h3>
                        <p class="text-[10px] text-slate-400 font-semibold mt-1">Daftar registrasi terbaru yang masuk.</p>
                    </div>
                    <a href="{{ route('admin.interns') }}" class="text-[9px] font-extrabold text-blue-600 hover:text-blue-700 bg-blue-50 px-2 py-1 rounded-lg border border-blue-100">
                        + Lihat Semua
                    </a>
                </div>

                <div class="space-y-4 mt-6">
                    @php
                        $members = [
                            ['Alexandra Deff', 'Universitas Airlangga', 'Disetujui', 'bg-emerald-50 text-emerald-700 border-emerald-100', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150'],
                            ['Edwin Adenike', 'Institut Teknologi Sepuluh Nopember', 'Proses', 'bg-amber-50 text-amber-700 border-amber-100', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150'],
                            ['Isaac Oluwatemilorun', 'Universitas Brawijaya', 'Pending', 'bg-slate-50 text-slate-600 border-slate-200/60', 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=150'],
                            ['David Oshodi', 'Universitas Gadjah Mada', 'Proses', 'bg-amber-50 text-amber-700 border-amber-100', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150']
                        ];
                    @endphp
                    @foreach($members as $member)
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2.5 last:border-0 last:pb-0">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-200 shrink-0">
                                <img src="{{ $member[4] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0 leading-none">
                                <p class="text-xs font-bold text-slate-800 truncate leading-none">{{ $member[0] }}</p>
                                <span class="text-[9px] text-slate-400 font-semibold truncate leading-none mt-1.5 block">{{ $member[1] }}</span>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full border {{ $member[3] }} text-[8px] font-extrabold tracking-wide uppercase">
                            {{ $member[2] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Column 2: Progress Radial Gauge (width: 3/12) -->
            <div class="content-card p-6 lg:col-span-3 flex flex-col justify-between items-center text-center">
                <div class="w-full text-left">
                    <h3 class="text-sm font-bold text-slate-900 leading-none">Progres Kelulusan</h3>
                    <p class="text-[10px] text-slate-400 font-semibold mt-1">Metrik keberhasilan program magang.</p>
                </div>
                
                <!-- SVG Half circle progress ring just like Donezo -->
                <div class="relative flex items-center justify-center my-4">
                    <svg class="w-32 h-16 transform -scale-x-1" viewBox="0 0 100 50">
                        <!-- Background arc path -->
                        <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#f1f5f9" stroke-width="12" stroke-linecap="round" />
                        <!-- Active blue arc path (86% progress) -->
                        <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#2563eb" stroke-width="12" stroke-linecap="round" stroke-dasharray="125.6" stroke-dashoffset="20" />
                    </svg>
                    
                    <!-- Center indicator text -->
                    <div class="absolute bottom-0 text-center leading-none">
                        <span class="text-2xl font-black text-slate-800 leading-none">86%</span>
                        <p class="text-[8px] text-slate-400 font-bold uppercase mt-1 leading-none">Selesai</p>
                    </div>
                </div>

                <!-- Legend labels matching reference grid -->
                <div class="flex items-center justify-center gap-3 text-[8px] font-black text-slate-500 uppercase tracking-widest mt-2">
                    <div class="flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        <span>Aktif</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>Proses</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                        <span>Alumni</span>
                    </div>
                </div>
            </div>

            <!-- Column 3: Time Tracker Clock (width: 4/12) -->
            <div class="content-card p-6 lg:col-span-4 flex flex-col justify-between bg-slate-950 text-white relative overflow-hidden group">
                <!-- Glowing abstract grid waves in background -->
                <div class="absolute -right-10 -bottom-10 w-36 h-36 rounded-full bg-blue-500/10 blur-2xl pointer-events-none"></div>
                <div class="absolute inset-0 grid-bg-dark opacity-10 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <h3 class="text-xs font-bold text-slate-400 tracking-wider uppercase leading-none">Waktu Berjalan</h3>
                    <p class="text-[10px] text-blue-400 font-semibold mt-1">Durasi monitoring aktif hari ini.</p>
                </div>

                <!-- Clock face displaying 01:24:08 Donezo Digital style -->
                <div class="my-6 text-center relative z-10">
                    <span class="text-4xl font-extrabold text-blue-400 tracking-widest font-mono select-none drop-shadow-[0_2px_10px_rgba(59,130,246,0.3)]">01:24:08</span>
                </div>

                <!-- Tracker Control buttons -->
                <div class="flex justify-center items-center gap-4 relative z-10">
                    <!-- Play/Pause white capsule circle -->
                    <button class="w-10 h-10 rounded-full bg-white hover:bg-slate-50 flex items-center justify-center text-slate-800 shadow-md transform hover:scale-105 active:scale-95 transition">
                        <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                    </button>
                    <!-- Stop red/orange circle -->
                    <button class="w-8 h-8 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center text-white shadow-md transform hover:scale-105 active:scale-95 transition">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M6 6h12v12H6V6z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Banner -->
        <x-footer-banner />
    </div>
</x-app-layout>
