<div class="sidebar-width bg-slate-900 flex-shrink-0 flex flex-col min-h-screen sticky top-0 z-40">
    <!-- Brand -->
    <div class="h-20 flex items-center px-6 border-b border-slate-800">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto rounded bg-white p-0.5" alt="SIMASOS">
            <div class="leading-tight">
                <span class="block text-white font-bold tracking-tight text-lg">SIMASOS</span>
                <span class="block text-slate-400 text-[10px] uppercase font-bold tracking-wider">Dinsos Lamongan</span>
            </div>
        </a>
    </div>

    <!-- Nav -->
    <div class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
        @if(auth()->user()->role === 'admin')
            <div>
                <p class="px-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📊</span> Dashboard
                    </a>
                </div>
            </div>

            <div>
                <p class="px-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Internship</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.interns') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.interns') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>👥</span> Data Peserta
                    </a>
                    <a href="{{ route('admin.alumni') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.alumni') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>🎓</span> Alumni Magang
                    </a>
                </div>
            </div>

            <div>
                <p class="px-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Monitoring</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.attendances') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.attendances') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📋</span> Pantau Absensi
                    </a>
                    <a href="{{ route('admin.journals') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.journals') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📝</span> Jurnal Kegiatan
                    </a>
                    <a href="{{ route('admin.evaluations') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.evaluations') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>⭐</span> Penilaian Akhir
                    </a>
                </div>
            </div>
        @else
            <div>
                <p class="px-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Intern Menu</p>
                <div class="space-y-1">
                    <a href="{{ route('intern.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('intern.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>🏠</span> Dashboard
                    </a>
                    <a href="{{ route('intern.card') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('intern.card') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>🪪</span> ID Card Magang
                    </a>
                    <a href="{{ route('intern.attendance') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('intern.attendance') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📋</span> Absensi Harian
                    </a>
                    <a href="{{ route('intern.journals') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('intern.journals') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>📝</span> Jurnal Kegiatan
                    </a>
                    <a href="{{ route('intern.evaluation') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('intern.evaluation') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span>⭐</span> Penilaian Akhir
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="p-4 border-t border-slate-800 bg-slate-900/50">
        <div class="flex items-center gap-3 px-2 mb-4">
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-slate-500 truncate">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-bold text-red-400 hover:bg-red-400/10 rounded-lg transition-colors">
                🚪 Log Out
            </button>
        </form>
    </div>
</div>
