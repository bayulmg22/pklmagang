<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Hasil Evaluasi Magang') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        <div class="content-card p-10 relative overflow-hidden">
            <!-- Decorative Seal Background -->
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-slate-50 rounded-full flex items-center justify-center opacity-50">
                <div class="w-48 h-48 border-8 border-white rounded-full"></div>
            </div>

            <div class="relative z-10 text-center mb-12">
                <img src="{{ asset('logo-dinsos.jpg') }}" class="h-16 w-auto mx-auto mb-4 bg-white p-1 rounded shadow-sm" alt="Logo">
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">LAPORAN PENILAIAN MAGANG</h3>
                <p class="text-slate-500 font-bold uppercase tracking-[0.2em] text-xs mt-2">Dinas Sosial Kabupaten Lamongan</p>
                <div class="w-24 h-1 bg-blue-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Identitas Peserta</p>
                    <div class="space-y-3">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Nama Lengkap</span>
                            <span class="text-sm font-bold text-slate-800 uppercase tracking-tight">{{ $user->name }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Nomor Induk (NIM/NISN)</span>
                            <span class="text-sm font-bold text-slate-800 tracking-wider">{{ $user->nim }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Instansi / Sekolah</span>
                            <span class="text-sm font-bold text-slate-800 uppercase tracking-tight">{{ $user->school }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Evaluasi Akhir</p>
                    <div class="bg-slate-900 rounded-2xl p-6 text-white flex items-center justify-between shadow-xl">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Skor Rata-rata</p>
                            <p class="text-4xl font-black">{{ $evaluation ? number_format($evaluation->average, 1) : '0.0' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Predikat</p>
                            <p class="text-3xl font-black {{ $evaluation ? 'text-blue-400' : 'text-slate-500' }}">{{ $evaluation ? $evaluation->predicate : 'Belum Dinilai' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 mb-10 shadow-inner">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-slate-200 pb-2">Rincian Penilaian Kompetensi</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                    @php
                        $items = [
                            'Kedisiplinan' => $evaluation->kedisiplinan ?? 0,
                            'Tanggung Jawab' => $evaluation->tanggung_jawab ?? 0,
                            'Kerja Sama Tim' => $evaluation->kerja_sama ?? 0,
                            'Kreativitas' => $evaluation->kreativitas ?? 0,
                            'Adaptasi' => $evaluation->kemampuan_beradaptasi ?? 0,
                            'Kualitas Hasil Kerja' => $evaluation->kualitas_hasil_kerja ?? 0,
                            'Penyusunan Laporan' => $evaluation->penyusunan_laporan ?? 0,
                        ];
                    @endphp
                    @foreach($items as $label => $val)
                    <div class="flex items-center justify-between group">
                        <span class="text-sm font-bold text-slate-600 uppercase tracking-tight group-hover:text-slate-900 transition-colors">{{ $label }}</span>
                        <div class="flex items-center gap-4">
                            <div class="w-32 h-1.5 bg-slate-200 rounded-full overflow-hidden hidden sm:block">
                                <div class="h-full bg-blue-600 rounded-full" style="width: {{ $val }}%"></div>
                            </div>
                            <span class="text-sm font-black text-slate-800 w-8 text-right">{{ $val }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-10 p-6 {{ $evaluation ? 'bg-blue-50 border-blue-600' : 'bg-slate-50 border-slate-300' }} border-l-4 rounded-r-2xl italic">
                <h4 class="text-[10px] font-black {{ $evaluation ? 'text-blue-800' : 'text-slate-500' }} uppercase tracking-widest mb-2">Pesan Pembimbing</h4>
                <p class="text-sm {{ $evaluation ? 'text-blue-700' : 'text-slate-400' }} leading-relaxed font-medium">
                    "{{ $evaluation->comments ?? 'Belum ada catatan dari pembimbing.' }}"
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 border-t border-slate-100 pt-8">
                @if($evaluation)
                    <a href="{{ route('intern.evaluation.print') }}" target="_blank" 
                       class="w-full sm:w-auto px-10 py-4 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg active:translate-y-0.5 text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        DOWNLOAD SERTIFIKAT NILAI (PDF)
                    </a>
                @else
                    <button disabled class="w-full sm:w-auto px-10 py-4 bg-slate-200 text-slate-400 rounded-xl font-bold text-sm cursor-not-allowed text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        DOWNLOAD SERTIFIKAT NILAI (PDF)
                    </button>
                    <p class="text-xs text-slate-500 mt-2 sm:mt-0 sm:ml-4">Sertifikat tersedia setelah penilaian diberikan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
