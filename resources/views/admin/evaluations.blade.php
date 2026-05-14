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
                    <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Nama Peserta</th>
                            <th class="px-6 py-4 font-bold text-center">Status</th>
                            <th class="px-6 py-4 font-bold text-center">Nilai Rata-rata</th>
                            <th class="px-6 py-4 font-bold text-center">Predikat</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($interns as $intern)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $intern->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $intern->nim }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($intern->status == 'finished')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase">Selesai Dinilai</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black bg-blue-50 text-blue-700 border border-blue-200 uppercase">Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-black text-slate-800">
                                        {{ $intern->evaluation ? number_format($intern->evaluation->average, 1) : '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($intern->evaluation)
                                        <span class="text-[10px] font-bold text-slate-600 italic">{{ $intern->evaluation->predicate }}</span>
                                    @else
                                        <span class="text-slate-300 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <button onclick="document.getElementById('modal-{{ $intern->id }}').classList.remove('hidden')" 
                                            class="px-4 py-1.5 bg-slate-900 text-white text-[10px] font-bold rounded-lg hover:bg-slate-800 transition shadow-sm">
                                            {{ $intern->evaluation ? 'EDIT NILAI' : 'BERI NILAI' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Design -->
                            <div id="modal-{{ $intern->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')"></div>
                                    
                                    <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                                        <form action="{{ route('admin.evaluations.store', $intern) }}" method="POST">
                                            @csrf
                                            <div class="bg-white p-6">
                                                <div class="mb-6">
                                                    <h3 class="text-lg font-bold text-slate-800">Input Penilaian Magang</h3>
                                                    <p class="text-xs text-slate-500">Peserta: <span class="font-bold text-blue-600">{{ $intern->name }}</span> ({{ $intern->nim }})</p>
                                                </div>

                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Kedisiplinan</label>
                                                        <input type="number" name="kedisiplinan" value="{{ $intern->evaluation->kedisiplinan ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Tanggung Jawab</label>
                                                        <input type="number" name="tanggung_jawab" value="{{ $intern->evaluation->tanggung_jawab ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Kerja Sama Tim</label>
                                                        <input type="number" name="kerja_sama" value="{{ $intern->evaluation->kerja_sama ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Kreativitas</label>
                                                        <input type="number" name="kreativitas" value="{{ $intern->evaluation->kreativitas ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Adaptasi</label>
                                                        <input type="number" name="kemampuan_beradaptasi" value="{{ $intern->evaluation->kemampuan_beradaptasi ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Kualitas Hasil</label>
                                                        <input type="number" name="kualitas_hasil_kerja" value="{{ $intern->evaluation->kualitas_hasil_kerja ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Penyusunan Laporan</label>
                                                        <input type="number" name="penyusunan_laporan" value="{{ $intern->evaluation->penyusunan_laporan ?? '' }}" min="0" max="100" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Tanggal Selesai Magang</label>
                                                        <input type="date" name="finished_at" value="{{ $intern->evaluation->finished_at ?? date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" required>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Komentar / Pesan Motivasi</label>
                                                        <textarea name="comments" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" placeholder="Tuliskan masukan untuk peserta..." required>{{ $intern->evaluation->comments ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse gap-2">
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition shadow-sm">SIMPAN PENILAIAN</button>
                                                <button type="button" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-100 transition">BATAL</button>
                                            </div>
                                        </form>
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
