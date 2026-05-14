<!-- Sidebar — SIMASOS Compact -->
<div class="w-52 bg-gradient-to-b from-blue-900 via-blue-800 to-teal-800 shadow-2xl flex-shrink-0 flex flex-col h-screen sticky top-0" style="min-width:210px;max-width:210px;">
    <!-- Logo -->
    <div class="flex items-center gap-2 px-4 py-3 border-b border-blue-700/40">
        <img src="{{ asset('logo-dinsos.jpg') }}" style="height:32px;width:auto;border-radius:5px;background:white;padding:2px;" alt="Logo">
        <div class="leading-tight">
            <p class="font-bold text-white text-xs">SIMASOS</p>
            <p class="text-blue-200 text-[10px]">Kab. Lamongan</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-2 py-3 overflow-hidden">
        @if(auth()->user()->role === 'admin')
            <p class="px-2 text-[9px] font-bold text-blue-300 uppercase tracking-widest mb-1.5">Dashboard</p>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>📊</span> Dashboard
            </a>

            <p class="px-2 text-[9px] font-bold text-blue-300 uppercase tracking-widest mb-1.5 mt-3">Peserta</p>
            <a href="{{ route('admin.interns') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.interns') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>👥</span> Data Peserta
            </a>
            <a href="{{ route('admin.alumni') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.alumni') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>🎓</span> Alumni
            </a>

            <p class="px-2 text-[9px] font-bold text-blue-300 uppercase tracking-widest mb-1.5 mt-3">Aktivitas</p>
            <a href="{{ route('admin.attendances') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.attendances') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>📋</span> Pantau Absensi
            </a>
            <a href="{{ route('admin.journals') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.journals') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>📝</span> Jurnal Kegiatan
            </a>
            <a href="{{ route('admin.evaluations') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('admin.evaluations') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>⭐</span> Penilaian Akhir
            </a>
        @else
            <p class="px-2 text-[9px] font-bold text-blue-300 uppercase tracking-widest mb-1.5">Menu Saya</p>
            <a href="{{ route('intern.dashboard') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('intern.dashboard') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('intern.card') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('intern.card') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>🪪</span> ID Card Magang
            </a>
            <a href="{{ route('intern.attendance') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('intern.attendance') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>📋</span> Absensi Harian
            </a>
            <a href="{{ route('intern.journals') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('intern.journals') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>📝</span> Jurnal Kegiatan
            </a>
            <a href="{{ route('intern.evaluation') }}"
               class="flex items-center gap-2 w-full px-3 py-2 rounded-lg mb-1 text-xs font-medium transition-all {{ request()->routeIs('intern.evaluation') ? 'bg-white text-blue-900 font-bold shadow' : 'text-blue-100 hover:bg-white/10' }}">
                <span>⭐</span> Penilaian Akhir
            </a>
        @endif
    </nav>

    <!-- User Info & Logout -->
    <div class="border-t border-blue-700/40 px-3 py-3 bg-blue-950/30">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-400 to-green-500 flex items-center justify-center text-white font-bold text-xs overflow-hidden border border-white/30 flex-shrink-0">
                @if(auth()->user()->photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-white truncate leading-tight">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-teal-300">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-1.5 w-full px-2 py-1.5 text-[11px] text-blue-200 hover:bg-white/10 rounded-md transition mb-0.5">
            ⚙️ Profil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-1.5 w-full px-2 py-1.5 text-[11px] text-red-300 hover:bg-red-500/20 rounded-md transition font-semibold">
                🚪 Keluar
            </button>
        </form>
    </div>
</div>
