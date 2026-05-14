<div class="sidebar-width bg-[#0f172a] flex-shrink-0 flex flex-col min-h-screen sticky top-0 z-40 border-r border-white/10">
    <!-- Brand -->
    <div class="h-20 flex items-center px-6 border-b border-white/5 relative bg-[#1e293b]">
        <a href="/" class="flex items-center gap-3">
            <div class="bg-white p-1 rounded-lg shadow-lg">
                <img src="{{ asset('logo-dinsos.jpg') }}" class="h-9 w-auto" alt="Logo">
            </div>
            <div class="flex flex-col">
                <span class="text-white font-black text-xl tracking-tighter leading-none">SIMASOS</span>
                <span class="text-blue-400 text-[8px] font-black uppercase tracking-[0.2em] mt-1">DINSOS LAMONGAN</span>
            </div>
        </a>
    </div>

    <!-- Nav -->
    <div class="flex-1 px-4 py-6 space-y-6 overflow-y-auto custom-scrollbar">
        @php
            $menus = auth()->user()->role === 'admin' ? [
                'DASHBOARD' => [
                    ['admin.dashboard', '📈', 'Dashboard'],
                ],
                'MANAJEMEN' => [
                    ['admin.interns', '👥', 'Data Peserta'],
                    ['admin.alumni', '🎓', 'Alumni Magang'],
                ],
                'MONITORING' => [
                    ['admin.attendances', '📋', 'Presensi'],
                    ['admin.journals', '📝', 'Jurnal'],
                    ['admin.evaluations', '⭐', 'Penilaian'],
                ]
            ] : [
                'MENU UTAMA' => [
                    ['intern.dashboard', '🏠', 'Dashboard'],
                    ['intern.card', '🪪', 'ID Card'],
                    ['intern.attendance', '📋', 'Presensi'],
                    ['intern.journals', '📝', 'Jurnal'],
                    ['intern.evaluation', '⭐', 'Penilaian'],
                ]
            ];
        @endphp

        @foreach($menus as $label => $items)
            <div>
                <p class="px-3 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">{{ $label }}</p>
                <div class="space-y-1">
                    @foreach($items as $item)
                        <a href="{{ route($item[0]) }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-bold transition-all {{ request()->routeIs($item[0]) ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <span class="text-base">{{ $item[1] }}</span>
                            {{ $item[2] }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
    <div class="p-4 bg-[#0f172a] border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-3 py-1.5 text-[9px] font-black text-rose-500 hover:bg-rose-500/10 rounded-md transition-all border border-rose-500/20 uppercase tracking-widest mx-auto">
                🚪 Logout
            </button>
        </form>
    </div>
</div>
