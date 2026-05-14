<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="flex flex-col md:flex-row justify-between items-end gap-2 animate-fade">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Ringkasan Sistem</h1>
                <p class="text-xs font-medium text-slate-500">Monitor operasional magang secara real-time.</p>
            </div>
            <div class="text-right hidden md:block">
                <div class="flex items-center gap-2 justify-end bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">
                    <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Sistem Online</span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['Total Pendaftar', $stats['total_interns'], '👥', 'blue'],
                ['Menunggu ACC', $stats['pending'], '⏳', 'amber'],
                ['Peserta Aktif', $stats['active'], '✅', 'emerald'],
                ['Alumni Selesai', $stats['alumni'], '🎓', 'indigo']
            ] as $stat)
            <div class="content-card p-4 relative group overflow-hidden">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-11 h-11 rounded-xl bg-{{ $stat[3] }}-50 text-{{ $stat[3] }}-600 flex items-center justify-center text-xl shadow-sm border border-{{ $stat[3] }}-100 group-hover:scale-110 transition-transform">
                        {{ $stat[2] }}
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ $stat[0] }}</p>
                        <h3 class="text-xl font-black text-slate-900 leading-none">{{ $stat[1] }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Quick Access -->
        <div class="content-card overflow-hidden">
            <div class="px-6 py-3 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Navigasi Fitur</h3>
                <div class="w-6 h-6 rounded-full bg-white shadow-sm flex items-center justify-center text-[10px]">⚡</div>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['Data Peserta', 'admin.interns', '👥', 'blue'],
                    ['Absensi', 'admin.attendances', '📋', 'emerald'],
                    ['Jurnal', 'admin.journals', '📝', 'indigo'],
                    ['Penilaian', 'admin.evaluations', '⭐', 'amber']
                ] as $menu)
                <a href="{{ route($menu[1]) }}" class="group p-4 rounded-xl border border-slate-100 hover:border-{{ $menu[3] }}-200 hover:bg-{{ $menu[3] }}-50/30 transition-all flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-lg group-hover:scale-110 transition-all border border-slate-50">
                        {{ $menu[2] }}
                    </div>
                    <p class="text-xs font-bold text-slate-800 tracking-tight">{{ $menu[0] }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
