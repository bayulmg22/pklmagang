<div class="w-full h-full flex flex-col bg-white text-slate-600 select-none relative border-r border-slate-200">
    <!-- Sidebar Toggle Button (Desktop Only) -->
    <button @click="sidebarMinimized = !sidebarMinimized" 
            class="hidden lg:flex absolute -right-3.5 top-7 bg-white border border-slate-200 text-slate-400 hover:text-blue-600 rounded-full p-1.5 shadow-sm z-50 transition-transform duration-300" 
            :class="sidebarMinimized ? 'rotate-180' : ''" 
            title="Toggle Sidebar">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
    </button>

    <!-- Brand Header -->
    <div class="h-20 flex items-center px-6 border-b border-slate-100 shrink-0 relative z-10 group-[.is-minimized]/sidebar:px-0 group-[.is-minimized]/sidebar:justify-center transition-all duration-300">
        <div class="flex items-center gap-3">
            <div class="bg-blue-50 p-1.5 rounded-xl border border-blue-100 shrink-0 flex items-center justify-center group-[.is-minimized]/sidebar:w-10 group-[.is-minimized]/sidebar:h-10 transition-all duration-300">
                <img src="{{ asset('logo-dinsos.jpg') }}" class="h-7 w-auto object-contain mix-blend-multiply group-[.is-minimized]/sidebar:h-6 transition-all duration-300" alt="Logo">
            </div>
            <div class="flex flex-col group-[.is-minimized]/sidebar:hidden transition-all duration-300">
                <span class="text-slate-900 font-extrabold text-base tracking-tight leading-none">SIMASOS</span>
                <span class="text-blue-600 text-[8px] font-black uppercase tracking-widest mt-1.5 leading-none">Dinsos Lamongan</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 px-4 py-6 space-y-6 overflow-y-auto custom-scrollbar relative z-10">
        @php
            \Carbon\Carbon::setLocale('id');
            $user = auth()->user();
            $role = $user ? $user->role : 'guest';
            
            // Modern SVG Icons Mapping (Precise outline SVGs matching Donezo layout)
            $icons = [
                'dashboard' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>',
                'interns' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 10.089 20.5c-2.029 0-3.96-.53-5.658-1.466v-.109c0-1.113.285-2.16.786-3.07M10.089 20.5a11.386 11.386 0 0 1-5.02-1.28v-.109a11.386 11.386 0 0 1 5.02-1.28v.109M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 2.25a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5-3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>',
                'alumni' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0 A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>',
                'attendance' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
                'journals' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 0a9.06 9.06 0 0 0-1.5.124M12 3.75a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1-.75-.75V4.5a.75.75 0 0 1 .75-.75h1.5Z" /></svg>',
                'evaluation' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.477.81-.477.982 0l1.83 5.093a.5.5 0 0 0 .475.345l5.241.246c.506.024.707.656.319.988l-3.93 3.356a.5.5 0 0 0-.159.49l1.169 5.174c.113.502-.42.89-.853.62l-4.568-2.848a.5.5 0 0 0-.528 0l-4.568 2.848c-.433.27-.966-.118-.853-.62l1.169-5.174a.5.5 0 0 0-.159-.49L3.52 10.17c-.388-.332-.187-.964.319-.988l5.241-.246a.5.5 0 0 0 .475-.345l1.83-5.093Z" /></svg>',
                'card' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm-1.2 5.385a4.125 4.125 0 0 0-1.35-.135c-.482 0-.965.045-1.44.135m5.58 0a4.125 4.125 0 0 1-1.35-.135c-.482 0-.965.045-1.44.135m0 0a2.25 2.25 0 1 0 2.88 0Z" /></svg>',
                'messages' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>',
                'notifications' => '<svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>'
            ];
            
            $adminMenus = [
                'MENU UTAMA' => [
                    ['admin.dashboard', 'dashboard', 'Dashboard'],
                    ['admin.interns', 'interns', 'Data Peserta'],
                    ['admin.alumni', 'alumni', 'Alumni'],
                ],
                'MONITORING' => [
                    ['admin.attendances', 'attendance', 'Presensi'],
                    ['admin.journals', 'journals', 'Jurnal'],
                    ['admin.evaluations', 'evaluation', 'Penilaian'],
                    ['admin.messages', 'messages', 'Kirim Pesan'],
                ]
            ];
            $internMenus = [
                'MENU UTAMA' => [
                    ['intern.dashboard', 'dashboard', 'Dashboard'],
                    ['intern.card', 'card', 'ID Card'],
                    ['intern.attendance', 'attendance', 'Presensi'],
                    ['intern.journals', 'journals', 'Jurnal'],
                    ['intern.evaluation', 'evaluation', 'Penilaian'],
                    ['intern.notifications', 'notifications', 'Pusat Notifikasi'],
                ]
            ];
            
            if ($role === 'admin') {
                $menus = $adminMenus;
            } elseif ($role === 'intern') {
                $menus = $internMenus;
            } else {
                $menus = [];
            }
        @endphp

        @foreach($menus as $label => $items)
            <div class="mb-6">
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.25em] mb-2.5 group-[.is-minimized]/sidebar:hidden">{{ $label }}</p>
                <div class="space-y-1 group-[.is-minimized]/sidebar:space-y-2">
                    @foreach($items as $item)
                        @php
                            $isActive = request()->routeIs($item[0]);
                            $iconKey = $item[1];
                            $iconSvg = $icons[$iconKey] ?? $icons['dashboard'];
                        @endphp
                        <a href="{{ route($item[0]) }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-[13px] font-semibold border relative group transition-all duration-200 {{ $isActive ? 'bg-blue-50/70 text-blue-600 border-blue-100/50' : 'text-slate-500 border-transparent hover:bg-slate-50 hover:text-slate-900' }} group-[.is-minimized]/sidebar:justify-center group-[.is-minimized]/sidebar:px-0"
                           title="{{ $item[2] }}">
                            
                            <!-- Icon wrapper with dynamic colors matching the active state -->
                            <span class="transition-transform duration-200 group-hover:scale-105 shrink-0 {{ $isActive ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">
                                {!! $iconSvg !!}
                            </span>
                            
                            <!-- Menu label text -->
                            <span class="tracking-wide text-xs group-[.is-minimized]/sidebar:hidden">{{ $item[2] }}</span>

                            <!-- Active left vertical border bar -->
                            @if($isActive)
                                <div class="absolute left-0 top-2.5 bottom-2.5 w-1 bg-blue-600 rounded-r-full animate-fade-in group-[.is-minimized]/sidebar:w-1.5 group-[.is-minimized]/sidebar:left-0.5"></div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Donezo-style "Download App" Guide Card -->
    <div class="p-4 shrink-0 relative z-10 group-[.is-minimized]/sidebar:hidden transition-all duration-300">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-4 text-white relative overflow-hidden shadow-md shadow-blue-500/10">
            <!-- Decorative light waves in card background -->
            <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
            <div class="absolute -left-4 -top-4 w-16 h-16 rounded-full bg-white/5 blur-lg pointer-events-none"></div>
            
            <div class="relative z-10 space-y-3">
                <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center border border-white/20 shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-bold leading-tight">Panduan Magang</p>
                    <p class="text-[9px] text-blue-100/80 leading-normal">Unduh pedoman resmi pelaksanaan magang Dinas Sosial.</p>
                </div>
                <a href="#" class="block w-full py-2 px-3 text-center text-[10px] font-black text-blue-700 bg-white hover:bg-blue-50 rounded-xl transition duration-200 shadow-sm uppercase tracking-wider transform active:scale-95">
                    Download PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Logout Area -->
    @auth
    <div class="p-4 bg-slate-50 border-t border-slate-100 shrink-0 relative z-10 group-[.is-minimized]/sidebar:px-2 group-[.is-minimized]/sidebar:py-4 transition-all duration-300">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-500 hover:text-slate-800 bg-white hover:bg-slate-50 rounded-xl border border-slate-200 transition-all duration-200 uppercase tracking-wider transform active:scale-95 shadow-sm group-[.is-minimized]/sidebar:px-0" title="Logout">
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" /></svg>
                <span class="group-[.is-minimized]/sidebar:hidden">Logout</span>
            </button>
        </form>
    </div>
    @endauth
</div>
