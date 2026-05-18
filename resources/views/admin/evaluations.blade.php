<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Penilaian Akhir Magang') }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-fade-in">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                <span class="text-emerald-500 text-lg">✓</span> {{ session('success') }}
            </div>
        @endif

        <!-- Main Card Section -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300">
            <!-- Table Header Controls -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-800 text-base">Evaluasi Kinerja Peserta</h3>
                    <p class="text-xs text-slate-400 mt-1">Berikan penilaian komprehensif bagi peserta magang yang telah menyelesaikan program.</p>
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
                            <th class="px-8 py-5 font-bold">Peserta Magang</th>
                            <th class="px-8 py-5 font-bold text-center">Status</th>
                            <th class="px-8 py-5 font-bold text-center">Nilai Rata-Rata</th>
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
                                            <div class="font-bold text-slate-800 text-sm">{{ $intern->name }}</div>
                                            <div class="text-[11px] text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">
                                                ID: {{ $intern->nim ?? '-' }} — {{ $intern->school }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    @if($intern->status == 'finished')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-black bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-black bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wider">
                                            Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-center">
                                    @if($intern->evaluation)
                                        <div class="flex flex-col items-center gap-0.5">
                                            <span class="text-sm font-black text-slate-800">{{ number_format($intern->evaluation->average, 1) }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">({{ $intern->evaluation->predicate }})</span>
                                        </div>
                                    @else
                                        <span class="text-slate-300 text-xs italic font-medium">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center">
                                        <button onclick="document.getElementById('modal-{{ $intern->id }}').classList.remove('hidden')" 
                                            class="px-4 py-2 border rounded-xl text-[10px] font-bold uppercase tracking-wider transition-all {{ $intern->evaluation ? 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' : 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 hover:shadow-md' }}">
                                            {{ $intern->evaluation ? 'Edit Nilai' : 'Beri Nilai' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal: Scoring Form Redesigned -->
                            <div id="modal-{{ $intern->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <!-- Backdrop -->
                                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')"></div>
                                    
                                    <!-- Modal Content -->
                                    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl overflow-hidden transform transition-all animate-slide-up">
                                        <!-- Modal Header -->
                                        <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-8 py-6 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                            <div>
                                                <h3 class="font-extrabold text-lg uppercase tracking-wider">Input Penilaian Akhir</h3>
                                                <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Berikan nilai performa dan kelulusan peserta magang.</p>
                                            </div>
                                            <div class="text-left sm:text-right shrink-0">
                                                <div class="text-sm font-black text-blue-400 uppercase tracking-wider">{{ $intern->name }}</div>
                                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">{{ $intern->nim ?? '-' }} — {{ $intern->school }}</div>
                                            </div>
                                        </div>

                                        <!-- Form -->
                                        <form action="{{ route('admin.evaluations.store', $intern) }}" method="POST" class="p-8 space-y-6">
                                            @csrf
                                            
                                            <!-- Dynamic Calculation Display -->
                                            <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-100/50 flex flex-col sm:flex-row justify-between items-center gap-4">
                                                <div>
                                                    <span class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest">Rata-Rata Sementara</span>
                                                    <div class="text-3xl font-black text-slate-800 mt-1">
                                                        <span id="avg-display-{{ $intern->id }}">{{ $intern->evaluation ? number_format($intern->evaluation->average, 1) : '0.0' }}</span>
                                                        <span class="text-sm text-slate-400 font-bold">/ 100</span>
                                                    </div>
                                                </div>
                                                <div class="text-center sm:text-right">
                                                    <span class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest">Predikat</span>
                                                    <div class="mt-1">
                                                        <span id="pred-display-{{ $intern->id }}" class="inline-flex px-3.5 py-1.5 rounded-xl text-xs font-black bg-blue-100 text-blue-800 border border-blue-200 uppercase tracking-wide">
                                                            {{ $intern->evaluation ? $intern->evaluation->predicate : 'D (Kurang)' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                                                @php
                                                    $fields = [
                                                        ['kedisiplinan', 'Kedisiplinan'],
                                                        ['tanggung_jawab', 'Tanggung Jawab'],
                                                        ['kerja_sama', 'Kerja Sama'],
                                                        ['kreativitas', 'Kreativitas'],
                                                        ['kemampuan_beradaptasi', 'Adaptasi & Sikap'],
                                                        ['kualitas_hasil_kerja', 'Kualitas Kerja'],
                                                        ['penyusunan_laporan', 'Laporan Magang'],
                                                    ];
                                                @endphp

                                                @foreach($fields as $field)
                                                    <div class="space-y-1.5 bg-slate-50 p-4 rounded-2xl border border-slate-100/80 focus-within:border-blue-500/20 focus-within:bg-white transition-all duration-200">
                                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">{{ $field[1] }}</label>
                                                        <div class="relative">
                                                            <input type="number" 
                                                                name="{{ $field[0] }}" 
                                                                value="{{ $intern->evaluation->{$field[0]} ?? '' }}" 
                                                                min="0" max="100" 
                                                                oninput="calculateModalAverage({{ $intern->id }})"
                                                                class="score-input-{{ $intern->id }} w-full bg-transparent border-none p-0 text-lg font-black text-slate-800 focus:ring-0 outline-none placeholder-slate-300" 
                                                                placeholder="0" required>
                                                            <span class="absolute right-0 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-300">/ 100</span>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <!-- Finished At -->
                                                <div class="space-y-1.5 bg-slate-50 p-4 rounded-2xl border border-slate-100/80 focus-within:border-blue-500/20 focus-within:bg-white transition-all duration-200">
                                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Tanggal Selesai</label>
                                                    <input type="date" name="finished_at" value="{{ $intern->evaluation->finished_at ?? date('Y-m-d') }}" 
                                                        class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0 outline-none" required>
                                                </div>

                                                <!-- Comments -->
                                                <div class="col-span-1 sm:col-span-2 md:col-span-3 space-y-1.5 bg-slate-50 p-4 rounded-2xl border border-slate-100/80 focus-within:border-blue-500/20 focus-within:bg-white transition-all duration-200">
                                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Evaluasi & Catatan Akhir Mentor</label>
                                                    <textarea name="comments" rows="3" 
                                                        class="w-full bg-transparent border-none p-0 text-xs font-semibold text-slate-600 focus:ring-0 outline-none resize-none" 
                                                        placeholder="Berikan masukan tertulis mengenai performa dan kompetensi peserta magang secara keseluruhan..." required>{{ $intern->evaluation->comments ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Modal Footer Actions -->
                                            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                                                <button type="submit" class="flex-1 bg-slate-900 text-white font-extrabold py-4 rounded-2xl hover:bg-blue-600 shadow-sm transition-all uppercase tracking-wider text-xs">Simpan & Publikasikan Kelulusan</button>
                                                <button type="button" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')" 
                                                    class="px-8 bg-slate-100 text-slate-500 font-extrabold py-4 rounded-2xl hover:bg-slate-200 transition-all uppercase tracking-wider text-xs">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="text-4xl mb-3">⭐</div>
                                    <h4 class="font-extrabold text-slate-700 text-sm">Tidak Ada Peserta Untuk Dinilai</h4>
                                    <p class="text-slate-400 text-xs mt-1">Belum ada peserta aktif atau selesai magang saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Interactive Score Calculator -->
    <script>
        function calculateModalAverage(id) {
            const inputs = document.querySelectorAll('.score-input-' + id);
            let sum = 0;
            let count = 0;
            
            inputs.forEach(input => {
                const val = parseFloat(input.value);
                if (!isNaN(val) && val >= 0 && val <= 100) {
                    sum += val;
                    count++;
                }
            });
            
            const average = count > 0 ? (sum / count) : 0;
            
            // Update display
            const avgDisplay = document.getElementById('avg-display-' + id);
            const predDisplay = document.getElementById('pred-display-' + id);
            
            if (avgDisplay) {
                avgDisplay.textContent = average.toFixed(1);
            }
            
            if (predDisplay) {
                let predicate = 'D (Kurang)';
                let styleClasses = 'bg-rose-50 text-rose-700 border-rose-200';
                
                if (average >= 85) {
                    predicate = 'A (Sangat Baik)';
                    styleClasses = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                } else if (average >= 70) {
                    predicate = 'B (Baik)';
                    styleClasses = 'bg-blue-50 text-blue-700 border-blue-200';
                } else if (average >= 55) {
                    predicate = 'C (Cukup)';
                    styleClasses = 'bg-amber-50 text-amber-700 border-amber-200';
                }
                
                predDisplay.textContent = predicate;
                predDisplay.className = 'inline-flex px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wide border ' + styleClasses;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Search Filtering
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
