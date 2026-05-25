<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Monitoring Jurnal Kegiatan') }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-fade-in">
        <!-- Quick Stats Banner -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Jurnal Dikirim</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        @php
                            $flatJournals = collect();
                            foreach($journalsGrouped as $date => $group) {
                                $flatJournals = $flatJournals->concat($group);
                            }
                        @endphp
                        {{ $flatJournals->count() }} <span class="text-xs font-semibold text-slate-400">Jurnal</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Jurnal dengan Dokumentasi Foto</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        {{ $flatJournals->filter(fn($j) => $j->photo_path)->count() }} <span class="text-xs font-semibold text-slate-400">Foto</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card Section -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300">
            <!-- Table Header Controls -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base">Aktivitas Harian Peserta</h3>
                    <p class="text-xs text-slate-400 mt-1">Pantau dan awasi rincian aktivitas dan progres magang harian.</p>
                </div>
                
                <!-- Search & Filters -->
                <div class="flex items-center gap-3">
                    <div class="relative w-full sm:w-64">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                        </span>
                        <input id="searchInput" type="text" placeholder="Cari nama atau keyword kegiatan..." class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 font-bold">Waktu</th>
                            <th class="px-8 py-5 font-bold">Nama Peserta</th>
                            <th class="px-8 py-5 font-bold w-1/2">Detail Aktivitas</th>
                            <th class="px-8 py-5 font-bold text-center">Dokumentasi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        @forelse ($journalsGrouped as $date => $journals)
                            <tr class="date-header bg-slate-100/40 sticky top-0 backdrop-blur-md">
                                <td colspan="4" class="px-8 py-3.5 text-xs font-black text-slate-700 uppercase tracking-[0.25em] border-y border-slate-200/60 bg-slate-50">
                                    🗓️ {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            @foreach($journals as $journal)
                                @php
                                    $colors = ['bg-blue-50 text-blue-600', 'bg-emerald-50 text-emerald-600', 'bg-indigo-50 text-indigo-600', 'bg-purple-50 text-purple-600', 'bg-amber-50 text-amber-600', 'bg-rose-50 text-rose-600'];
                                    $name = $journal->user?->name ?? 'N/A';
                                    $colorIndex = (ord(substr($name, 0, 1)) + ord(substr($name, -1))) % count($colors);
                                    $avatarColor = $colors[$colorIndex];
                                    $initials = collect(explode(' ', $name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                                @endphp
                                <tr class="table-row hover:bg-slate-50/40 transition-colors duration-200">
                                    <td class="px-8 py-5 text-slate-500 font-semibold text-xs whitespace-nowrap">
                                        🕒 {{ $journal->created_at->format('H:i') }} WIB
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <!-- Mini Avatar -->
                                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center font-extrabold text-[10px] {{ $avatarColor }} border border-white shadow-sm">
                                                @if($journal->user && $journal->user->photo_path)
                                                    <img src="{{ asset('storage/' . $journal->user->photo_path) }}" class="w-full h-full object-cover rounded-full">
                                                @else
                                                    {{ strtoupper($initials) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800 text-sm">{{ $name }}</div>
                                                <div class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $journal->user?->school ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="pl-4 border-l-2 border-slate-200/80">
                                            <p class="text-slate-600 leading-relaxed text-xs font-medium">{{ $journal->activity }}</p>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex justify-center">
                                            @if($journal->photo_path)
                                                <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank" class="block group">
                                                    <div class="w-14 h-14 rounded-2xl overflow-hidden border-2 border-white shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all duration-200 bg-slate-100">
                                                        <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-full h-full object-cover">
                                                    </div>
                                                </a>
                                            @else
                                                <span class="text-slate-300 italic text-[10px] font-semibold bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100/50">No Photo</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr id="emptyRow">
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="w-10 h-10 mx-auto mb-3 text-slate-300">
                                        <svg class="w-full h-full text-current" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    </div>
                                    <h4 class="font-extrabold text-slate-700 text-sm">Tidak Ada Jurnal Aktivitas</h4>
                                    <p class="text-slate-400 text-xs mt-1">Belum ada catatan aktivitas harian yang dikirimkan.</p>
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
                    
                    if (activeHeader && !hasVisibleRow) {
                        activeHeader.style.display = 'none';
                    }
                });
            }
        });
    </script>
</x-app-layout>
