<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Penilaian Akhir Magang') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Evaluasi Kinerja Peserta</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Input Penilaian Akhir</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-[0.2em] bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-black">Peserta Magang</th>
                            <th class="px-6 py-4 font-black text-center">Status</th>
                            <th class="px-6 py-4 font-black text-center">Nilai Rata-Rata</th>
                            <th class="px-6 py-4 font-black text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($interns as $intern)
                            <tr class="hover:bg-slate-50 transition-all">
                                <td class="px-6 py-4">
                                    <div class="font-black text-slate-800 text-sm">{{ $intern->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $intern->nim }} — {{ $intern->school }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($intern->status == 'finished')
                                        <span class="text-[10px] font-black text-emerald-600 uppercase">Selesai</span>
                                    @else
                                        <span class="text-[10px] font-black text-sky-600 uppercase">Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($intern->evaluation)
                                        <span class="text-sm font-black text-slate-900">{{ number_format($intern->evaluation->average, 1) }}</span>
                                        <span class="text-[9px] font-black text-slate-400 ml-1">({{ $intern->evaluation->predicate }})</span>
                                    @else
                                        <span class="text-slate-300 text-xs italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <button onclick="document.getElementById('modal-{{ $intern->id }}').classList.remove('hidden')" 
                                            class="px-4 py-2 {{ $intern->evaluation ? 'bg-slate-100 text-slate-600' : 'bg-slate-900 text-white' }} text-[10px] font-black rounded-lg transition-all uppercase tracking-widest">
                                            {{ $intern->evaluation ? 'Edit Nilai' : 'Beri Nilai' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal: Compact Scoring Form -->
                            <div id="modal-{{ $intern->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')"></div>
                                    
                                    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden">
                                        <div class="bg-slate-900 px-6 py-4 text-white flex justify-between items-center">
                                            <h3 class="font-black text-sm uppercase tracking-widest">Input Penilaian Akhir</h3>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $intern->name }}</span>
                                        </div>

                                        <form action="{{ route('admin.evaluations.store', $intern) }}" method="POST" class="p-6">
                                            @csrf
                                            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                                                @php
                                                    $fields = [
                                                        ['kedisiplinan', 'Kedisiplinan'],
                                                        ['tanggung_jawab', 'Tanggung Jawab'],
                                                        ['kerja_sama', 'Kerja Sama'],
                                                        ['kreativitas', 'Kreativitas'],
                                                        ['kemampuan_beradaptasi', 'Adaptasi'],
                                                        ['kualitas_hasil_kerja', 'Kualitas Kerja'],
                                                    ];
                                                @endphp

                                                @foreach($fields as $field)
                                                    <div class="space-y-1">
                                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">{{ $field[1] }} (0-100)</label>
                                                        <input type="number" name="{{ $field[0] }}" value="{{ $intern->evaluation->{$field[0]} ?? '' }}" min="0" max="100" 
                                                            class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-black focus:border-slate-900 outline-none transition-all" required>
                                                    </div>
                                                @endforeach

                                                <div class="space-y-1">
                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Laporan Magang</label>
                                                    <input type="number" name="penyusunan_laporan" value="{{ $intern->evaluation->penyusunan_laporan ?? '' }}" min="0" max="100" 
                                                        class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-black focus:border-slate-900 outline-none transition-all" required>
                                                </div>

                                                <div class="space-y-1">
                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Tanggal Selesai</label>
                                                    <input type="date" name="finished_at" value="{{ $intern->evaluation->finished_at ?? date('Y-m-d') }}" 
                                                        class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-black focus:border-slate-900 outline-none transition-all" required>
                                                </div>

                                                <div class="col-span-2 space-y-1">
                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Komentar / Catatan Akhir</label>
                                                    <textarea name="comments" rows="2" 
                                                        class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm font-bold focus:border-slate-900 outline-none transition-all resize-none" required>{{ $intern->evaluation->comments ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="mt-6 flex gap-2">
                                                <button type="submit" class="flex-1 bg-slate-900 text-white font-black py-3 rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest text-[10px]">Simpan Penilaian</button>
                                                <button type="button" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')" 
                                                    class="px-6 bg-slate-100 text-slate-500 font-black py-3 rounded-xl hover:bg-slate-200 transition-all uppercase tracking-widest text-[10px]">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <p class="text-3xl mb-2">⭐</p>
                                    <p class="text-sm font-medium">Belum ada peserta aktif yang tersedia untuk dinilai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
