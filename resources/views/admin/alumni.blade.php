<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Data Alumni Magang') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Histori Kelulusan</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Alumni: {{ count($interns) }}</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Peserta & Instansi</th>
                            <th class="px-6 py-4 font-bold">Identitas</th>
                            <th class="px-6 py-4 font-bold">Nilai Akhir</th>
                            <th class="px-6 py-4 font-bold">Predikat Kelulusan</th>
                            <th class="px-6 py-4 font-bold">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($interns as $intern)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $intern->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $intern->school }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-medium">{{ $intern->nim }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-black text-slate-800">
                                        {{ $intern->evaluation ? number_format($intern->evaluation->average, 1) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($intern->evaluation)
                                        @php
                                            $pred = substr($intern->evaluation->predicate, 0, 1);
                                            $style = match($pred) {
                                                'A' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'B' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'C' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                default => 'bg-rose-50 text-rose-700 border-rose-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $style }} uppercase tracking-tighter">
                                            {{ $intern->evaluation->predicate }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ $intern->evaluation && $intern->evaluation->finished_at ? \Carbon\Carbon::parse($intern->evaluation->finished_at)->translatedFormat('d M Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <p class="text-3xl mb-2">🎓</p>
                                    <p class="text-sm font-medium">Belum ada data peserta yang menyelesaikan masa magang.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
