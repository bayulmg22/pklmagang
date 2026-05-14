<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total -->
            <div class="content-card p-6 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-sm border border-blue-100">👥</div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pendaftar</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_interns'] }}</h3>
                </div>
            </div>
            <!-- Pending -->
            <div class="content-card p-6 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shadow-sm border border-amber-100">⏳</div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu ACC</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['pending'] }}</h3>
                </div>
            </div>
            <!-- Active -->
            <div class="content-card p-6 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-sm border border-emerald-100">✅</div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Peserta Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['active'] }}</h3>
                </div>
            </div>
            <!-- Alumni -->
            <div class="content-card p-6 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl shadow-sm border border-indigo-100">🎓</div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alumni Selesai</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['alumni'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Quick Access -->
        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Menu Manajemen Cepat</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akses Langsung</span>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.interns') }}" class="group p-4 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50 transition-all flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-xl group-hover:scale-110 transition">👥</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Data Peserta</p>
                        <p class="text-[10px] text-slate-500">Kelola Status Magang</p>
                    </div>
                </a>
                <a href="{{ route('admin.attendances') }}" class="group p-4 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50 transition-all flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-xl group-hover:scale-110 transition">📋</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Pantau Absensi</p>
                        <p class="text-[10px] text-slate-500">Cek Kehadiran Harian</p>
                    </div>
                </a>
                <a href="{{ route('admin.journals') }}" class="group p-4 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50 transition-all flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-xl group-hover:scale-110 transition">📝</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Jurnal Kegiatan</p>
                        <p class="text-[10px] text-slate-500">Lihat Aktivitas Harian</p>
                    </div>
                </a>
                <a href="{{ route('admin.evaluations') }}" class="group p-4 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50 transition-all flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-xl group-hover:scale-110 transition">⭐</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Penilaian Akhir</p>
                        <p class="text-[10px] text-slate-500">Input Nilai & Predikat</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
