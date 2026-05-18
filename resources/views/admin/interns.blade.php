<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ $title ?? 'Manajemen Peserta Magang' }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-fade-in">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                <span class="text-emerald-500 text-lg">✓</span> {{ session('success') }}
            </div>
        @endif

        <!-- Quick Stats Banner -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 10.089 20M3 11.627a1.018 1.018 0 0 1 .832-1.02 11.242 11.242 0 0 1 3.228-.335c.882 0 1.746.101 2.58.297m0 0c.944.221 1.72.999 1.72 1.93v5.355m-5.16-6.425A3 3 0 0 0 6 8.5c0-.986.475-1.86 1.218-2.401A5.25 5.25 0 0 0 3 11.627m15-1.373a3.53 3.53 0 0 0-1.378-2.75 5.25 5.25 0 0 0-6.403-1.083M10.089 20H4.12c-.88 0-1.705-.265-2.394-.721a4.125 4.125 0 0 1 7.42-2.392m1.943 3.113C11.374 19.689 11.5 19.18 11.5 18.647v-.553" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Peserta & Pendaftar</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">{{ count($interns) }} <span class="text-xs font-semibold text-slate-400">Orang</span></div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Peserta Aktif</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">{{ $interns->where('status', 'approved')->count() }} <span class="text-xs font-semibold text-slate-400">Orang</span></div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-all duration-300">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Menunggu Persetujuan</div>
                    <div class="text-2xl font-black text-slate-800 mt-1.5">{{ $interns->where('status', 'pending')->count() }} <span class="text-xs font-semibold text-slate-400">Orang</span></div>
                </div>
            </div>
        </div>

        <!-- Main Card Section -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300">
            <!-- Table Header Controls -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base">Daftar Pendaftar & Peserta</h3>
                    <p class="text-xs text-slate-400 mt-1">Kelola permohonan magang dan pantau peserta aktif.</p>
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
                            <th class="px-8 py-5 font-bold">Nama & Instansi</th>
                            <th class="px-8 py-5 font-bold">NIM / Identitas</th>
                            <th class="px-8 py-5 font-bold">Proposal</th>
                            <th class="px-8 py-5 font-bold">Status</th>
                            <th class="px-8 py-5 font-bold text-center">Aksi</th>
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
                                    @if($intern->proposal_path)
                                        <a href="{{ asset('storage/' . $intern->proposal_path) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-blue-600 font-bold bg-blue-50/50 hover:bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-100 transition-all">
                                            <span>📄</span> PDF
                                        </a>
                                    @else
                                        <span class="text-slate-300 text-xs italic">Belum Diunggah</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    @if($intern->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @elseif($intern->status == 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                                        </span>
                                    @elseif($intern->status == 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-2">
                                        @if($intern->status == 'pending')
                                            <form action="{{ route('admin.interns.approve', $intern) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pendaftaran ini?')">
                                                @csrf
                                                <button type="submit" class="px-3.5 py-1.5 bg-blue-600 text-white text-[10px] font-bold rounded-xl hover:bg-blue-700 hover:shadow-md transition-all shadow-sm uppercase tracking-wider">Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.interns.reject', $intern) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
                                                @csrf
                                                <button type="submit" class="px-3.5 py-1.5 bg-white border border-slate-200 text-rose-600 text-[10px] font-bold rounded-xl hover:bg-rose-50 hover:border-rose-200 transition-all uppercase tracking-wider">Tolak</button>
                                            </form>
                                        @else
                                            <span class="text-slate-300 text-xs italic font-medium">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="text-4xl mb-3">📁</div>
                                    <h4 class="font-extrabold text-slate-700 text-sm">Tidak Ada Data Peserta</h4>
                                    <p class="text-slate-400 text-xs mt-1">Belum ada data pendaftar magang saat ini.</p>
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
