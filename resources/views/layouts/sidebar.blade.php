<div class="w-64 bg-gradient-to-b from-sky-100 to-emerald-100 flex-shrink-0 flex flex-col min-h-screen sticky top-0 z-40 border-r border-sky-200">
    <!-- Brand -->
    <div class="h-24 flex items-center px-6 bg-white/50 border-b border-sky-200 backdrop-blur-sm">
        <div class="flex items-center gap-3">
            <div class="bg-white p-1.5 rounded-lg shadow-sm border border-sky-100">
                <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto" alt="Logo">
            </div>
            <div class="flex flex-col">
                <span class="text-slate-900 font-black text-2xl tracking-tight leading-none">SIMASOS</span>
                <span class="text-sky-600 text-[10px] font-black uppercase tracking-widest mt-1">KAB. LAMONGAN</span>
            </div>
        </div>
    </div>

    <!-- Nav -->
    <div class="flex-1 px-4 py-6 space-y-8 overflow-y-auto custom-scrollbar">
        @php
            \Carbon\Carbon::setLocale('id');
            $role = auth()->user()->role;
            $adminMenus = [
                'ADMINISTRASI' => [
                    ['admin.dashboard', '📈', 'Dashboard'],
                    ['admin.interns', '👥', 'Data Peserta'],
                    ['admin.alumni', '🎓', 'Alumni'],
                ],
                'MONITORING' => [
                    ['admin.attendances', '📋', 'Presensi'],
                    ['admin.journals', '📝', 'Jurnal'],
                    ['admin.evaluations', '⭐', 'Penilaian'],
                ]
            ];
            $internMenus = [
                'MENU UTAMA' => [
                    ['intern.dashboard', '🏠', 'Dashboard'],
                    ['intern.card', '🪪', 'ID Card'],
                    ['intern.attendance', '📋', 'Presensi'],
                    ['intern.journals', '📝', 'Jurnal'],
                    ['intern.evaluation', '⭐', 'Penilaian'],
                ]
            ];
            $menus = $role === 'admin' ? $adminMenus : $internMenus;
        @endphp

        @foreach($menus as $label => $items)
            <div class="mb-6">
                <p class="px-2 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">{{ $label }}</p>
                <div class="space-y-1">
                    @foreach($items as $item)
                        <a href="{{ route($item[0]) }}" 
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-[13px] font-bold transition-all {{ request()->routeIs($item[0]) ? 'bg-white text-sky-700 shadow-sm border border-sky-100' : 'text-slate-600 hover:bg-white/40 hover:text-sky-700' }}">
                            <span class="text-lg">{{ $item[1] }}</span>
                            {{ $item[2] }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
    <div class="p-4 bg-white/30 border-t border-sky-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-black text-white bg-rose-500 hover:bg-rose-600 rounded-lg transition-all shadow-sm uppercase tracking-wider">
                🚪 LOGOUT
            </button>
        </form>
    </div>
</div>
