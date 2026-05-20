<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Data Alumni Magang') }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-fade-in">
        <!-- Quick Stats Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M12 13.489a50.702 50.702 0 0 1 7.74-3.342M12 13.489V21" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Alumni Lulus</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">{{ count($interns) }} <span class="text-xs font-semibold text-slate-400">Orang</span></div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.971-.659-1.171-.88-1.171-2.303 0-3.182 1.171-.879 3.07-.879 4.242 0 .88.66.88 1.619.88 1.619" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Rata-Rata Nilai Kelulusan</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">
                        @php
                            $averages = $interns->filter(fn($i) => $i->evaluation)->map(fn($i) => $i->evaluation->average);
                            $globalAverage = $averages->count() > 0 ? $averages->average() : 0;
                        @endphp
                        {{ number_format($globalAverage, 1) }} <span class="text-xs font-semibold text-slate-400">Skor</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card Section -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300">
            <!-- Table Header Controls -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base">Histori Kelulusan</h3>
                    <p class="text-xs text-slate-400 mt-1">Daftar alumni yang telah menyelesaikan masa bakti magang.</p>
                </div>
                
                <!-- Search & Filters -->
                <div class="flex items-center gap-3">
                    <div class="relative w-full sm:w-64">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                        </span>
                        <input id="searchInput" type="text" placeholder="Cari nama atau instansi..." class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 text-slate-700 font-medium">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 font-bold">Peserta & Instansi</th>
                            <th class="px-8 py-5 font-bold">Identitas / NIM</th>
                            <th class="px-8 py-5 font-bold">Nilai Akhir</th>
                            <th class="px-8 py-5 font-bold">Predikat Kelulusan</th>
                            <th class="px-8 py-5 font-bold">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        @forelse ($interns as $intern)
                            @php
                                $colors = ['bg-blue-50 text-blue-600', 'bg-emerald-50 text-emerald-600', 'bg-indigo-50 text-indigo-600', 'bg-purple-50 text-purple-600', 'bg-amber-50 text-amber-600', 'bg-rose-50 text-rose-600'];
                                $colorIndex = (ord(substr($intern->name, 0, 1)) + ord(substr($intern->name, -1))) % count($colors);
                                $avatarColor = $colors[$colorIndex];
                                $initials = collect(explode(' ', $intern->name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                            @endphp
                            <tr class="table-row hover:bg-slate-50/40 transition-colors duration-200">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <!-- Avatar -->
                                        <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center font-extrabold text-xs {{ $avatarColor }} border border-white shadow-sm">
                                            @if($intern->photo_path)
                                                <img src="{{ asset('storage/' . $intern->photo_path) }}" class="w-full h-full object-cover rounded-full">
                                            @else
                                                {{ strtoupper($initials) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 text-sm hover:text-blue-600 transition-colors">{{ $intern->name }}</div>
                                            <div class="text-[11px] text-slate-400 font-semibold mt-0.5 flex items-center gap-1.5">
                                                <span>🏫</span> {{ $intern->school }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="font-mono text-xs text-slate-500 font-semibold bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">{{ $intern->nim ?? 'N/A' }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    @if($intern->evaluation)
                                        <div class="flex items-center gap-2">
                                            <span class="font-black text-slate-800 text-sm">{{ number_format($intern->evaluation->average, 1) }}</span>
                                            <!-- Simple Grade Progress Bar -->
                                            <div class="w-12 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $intern->evaluation->average }}%"></div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-slate-300 text-xs italic">—</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    @if($intern->evaluation)
                                        @php
                                            $pred = $intern->evaluation->predicate;
                                            $style = 'bg-slate-50 text-slate-700 border-slate-200/60';
                                            if (str_contains($pred, 'A')) {
                                                $style = 'bg-emerald-50 text-emerald-700 border-emerald-200/60';
                                            } elseif (str_contains($pred, 'B')) {
                                                $style = 'bg-blue-50 text-blue-700 border-blue-200/60';
                                            } elseif (str_contains($pred, 'C')) {
                                                $style = 'bg-amber-50 text-amber-700 border-amber-200/60';
                                            }
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $style }} uppercase tracking-tighter">
                                            {{ $pred }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 text-xs italic">—</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-slate-500 font-semibold text-xs">
                                    {{ $intern->evaluation && $intern->evaluation->finished_at ? \Carbon\Carbon::parse($intern->evaluation->finished_at)->translatedFormat('d M Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="text-4xl mb-3">🎓</div>
                                    <h4 class="font-extrabold text-slate-700 text-sm">Tidak Ada Data Alumni</h4>
                                    <p class="text-slate-400 text-xs mt-1">Belum ada peserta yang menyelesaikan masa magang saat ini.</p>
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
                });
            }
        });
    </script>
</x-app-layout>
