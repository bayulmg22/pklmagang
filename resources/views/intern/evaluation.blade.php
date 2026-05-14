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
                            <p class="text-4xl font-black">{{ number_format($evaluation->average, 1) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Predikat</p>
                            <p class="text-3xl font-black text-blue-400">{{ $evaluation->predicate }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 mb-10 shadow-inner">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-slate-200 pb-2">Rincian Penilaian Kompetensi</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                    @php
                        $items = [
                            'Kedisiplinan' => $evaluation->kedisiplinan,
                            'Tanggung Jawab' => $evaluation->tanggung_jawab,
                            'Kerja Sama Tim' => $evaluation->kerja_sama,
                            'Kreativitas' => $evaluation->kreativitas,
                            'Adaptasi' => $evaluation->kemampuan_beradaptasi,
                            'Kualitas Hasil Kerja' => $evaluation->kualitas_hasil_kerja,
                            'Penyusunan Laporan' => $evaluation->penyusunan_laporan,
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

            <div class="mb-10 p-6 bg-blue-50 border-l-4 border-blue-600 rounded-r-2xl italic">
                <h4 class="text-[10px] font-black text-blue-800 uppercase tracking-widest mb-2">Pesan Pembimbing</h4>
                <p class="text-sm text-blue-700 leading-relaxed font-medium">"{{ $evaluation->comments }}"</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 border-t border-slate-100 pt-8">
                <a href="{{ route('intern.evaluation.print') }}" target="_blank" 
                   class="w-full sm:w-auto px-10 py-4 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg active:translate-y-0.5 text-center">
                    📥 DOWNLOAD SERTIFIKAT NILAI (PDF)
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
