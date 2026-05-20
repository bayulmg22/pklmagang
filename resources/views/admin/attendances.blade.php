<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Pantau Kehadiran Harian') }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-fade-in">
        <!-- Quick Stats Banner -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Rasio Kehadiran</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        @php
                            $flatAttendances = collect();
                            foreach($attendancesGrouped as $date => $group) {
                                $flatAttendances = $flatAttendances->concat($group);
                            }
                            $total = $flatAttendances->count();
                            $present = $flatAttendances->where('status', 'hadir')->count();
                            $ratio = $total > 0 ? ($present / $total) * 100 : 0;
                        @endphp
                        {{ number_format($ratio, 1) }}% <span class="text-xs font-semibold text-slate-400">Hadir</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5-3h7.5m-7.5 3h7.5m-3.433 3.044 1.162-.387a2.25 2.25 0 1 1 .595-4.408l-1.161.387a2.246 2.246 0 0 1-.596 4.408Z" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Izin / Sakit</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        {{ $flatAttendances->whereIn('status', ['izin', 'sakit'])->count() }} <span class="text-xs font-semibold text-slate-400">Laporan</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Rata-Rata Terlambat</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        {{ $flatAttendances->filter(fn($a) => str_contains(strtolower($a->keterangan), 'terlambat'))->count() }} <span class="text-xs font-semibold text-slate-400">Kali</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card Section -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300">
            <!-- Table Header Controls -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base">Rekapitulasi Absensi</h3>
                    <p class="text-xs text-slate-400 mt-1">Daftar kehadiran harian peserta magang secara realtime.</p>
                </div>
                
                <!-- Search & Filters -->
                <div class="flex items-center gap-3">
                    <div class="relative w-full sm:w-64">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                        </span>
                        <input id="searchInput" type="text" placeholder="Cari nama peserta..." class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 font-bold">Nama Peserta</th>
                            <th class="px-8 py-5 font-bold">Asal Instansi</th>
                            <th class="px-8 py-5 font-bold">Waktu Masuk</th>
                            <th class="px-8 py-5 font-bold">Waktu Pulang</th>
                            <th class="px-8 py-5 font-bold">Status</th>
                            <th class="px-8 py-5 font-bold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        @forelse ($attendancesGrouped as $date => $attendances)
                            <tr class="date-header bg-slate-100/40 sticky top-0 backdrop-blur-md">
                                <td colspan="6" class="px-8 py-3.5 text-xs font-black text-slate-700 uppercase tracking-[0.25em] border-y border-slate-200/60 bg-slate-50">
                                    🗓️ {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            @foreach($attendances as $attendance)
                                @php
                                    $colors = ['bg-blue-50 text-blue-600', 'bg-emerald-50 text-emerald-600', 'bg-indigo-50 text-indigo-600', 'bg-purple-50 text-purple-600', 'bg-amber-50 text-amber-600', 'bg-rose-50 text-rose-600'];
                                    $name = $attendance->user?->name ?? 'N/A';
                                    $colorIndex = (ord(substr($name, 0, 1)) + ord(substr($name, -1))) % count($colors);
                                    $avatarColor = $colors[$colorIndex];
                                    $initials = collect(explode(' ', $name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                                @endphp
                                <tr class="table-row hover:bg-slate-50/40 transition-colors duration-200">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <!-- Mini Avatar -->
                                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center font-extrabold text-[10px] {{ $avatarColor }} border border-white shadow-sm">
                                                @if($attendance->user && $attendance->user->photo_path)
                                                    <img src="{{ asset('storage/' . $attendance->user->photo_path) }}" class="w-full h-full object-cover rounded-full">
                                                @else
                                                    {{ strtoupper($initials) }}
                                                @endif
                                            </div>
                                            <div class="font-bold text-slate-800 text-sm">{{ $name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4 text-slate-500 font-semibold text-xs">
                                        {{ $attendance->user?->school ?? '-' }}
                                    </td>
                                    <td class="px-8 py-4">
                                        @if($attendance->check_in_time)
                                            <div class="flex items-center gap-1 text-slate-700 font-semibold text-xs">
                                                <span class="text-[10px]">🕒</span> {{ $attendance->check_in_time }}
                                            </div>
                                        @else
                                            <span class="text-slate-300 italic text-[11px]">—</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-4">
                                        @if($attendance->check_out_time)
                                            <div class="flex items-center gap-1 text-slate-700 font-semibold text-xs">
                                                <span class="text-[10px]">🕒</span> {{ $attendance->check_out_time }}
                                            </div>
                                        @else
                                            <span class="text-slate-300 italic text-[11px]">—</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-4">
                                        @php
                                            $statusClass = match($attendance->status) {
                                                'hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                                'izin' => 'bg-blue-50 text-blue-700 border-blue-200/60',
                                                'sakit' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                                default => 'bg-slate-50 text-slate-700 border-slate-200/60'
                                            };
                                            $dotClass = match($attendance->status) {
                                                'hadir' => 'bg-emerald-500',
                                                'izin' => 'bg-blue-500',
                                                'sakit' => 'bg-rose-500',
                                                default => 'bg-slate-500'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold border {{ $statusClass }} uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span> {{ $attendance->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-4">
                                        @if($attendance->keterangan)
                                            @php
                                                $isLate = str_contains(strtolower($attendance->keterangan), 'terlambat');
                                                $badgeClass = $isLate ? 'bg-amber-50 text-amber-700 border-amber-200/50' : 'bg-slate-50 text-slate-600 border-slate-200/50';
                                            @endphp
                                            <div class="inline-flex items-center px-2.5 py-1 {{ $badgeClass }} text-[10px] font-semibold rounded-lg border">
                                                {{ $attendance->keterangan }}
                                            </div>
                                        @else
                                            <span class="text-slate-300 italic text-[10px]">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr id="emptyRow">
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="text-4xl mb-3">📋</div>
                                    <h4 class="font-extrabold text-slate-700 text-sm">Tidak Ada Data Absensi</h4>
                                    <p class="text-slate-400 text-xs mt-1">Belum ada catatan absensi yang tercatat saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Search Implementation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.table-row');
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const query = e.target.value.toLowerCase().trim();
                    let currentHeader = null;
                    let visibleRowsInGroup = 0;
                    
                    // First hide/show rows
                    tableRows.forEach(row => {
                        const content = row.textContent.toLowerCase();
                        if (content.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Then hide date headers if all their rows are hidden
                    const tbody = document.getElementById('tableBody');
                    let children = Array.from(tbody.children);
                    
                    let activeHeader = null;
                    let hasVisibleRow = false;
                    
                    children.forEach((child) => {
                        if (child.classList.contains('date-header')) {
                            if (activeHeader && !hasVisibleRow) {
                                activeHeader.style.display = 'none';
                            }
                            activeHeader = child;
                            activeHeader.style.display = '';
                            hasVisibleRow = false;
                        } else if (child.classList.contains('table-row')) {
                            if (child.style.display !== 'none') {
                                hasVisibleRow = true;
                            }
                        }
                    });
                    
                    // Handle the last header
                    if (activeHeader && !hasVisibleRow) {
                        activeHeader.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-app-layout>
