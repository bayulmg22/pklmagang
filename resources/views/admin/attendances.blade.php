<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Pantau Kehadiran Harian') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Rekapitulasi Absensi</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Update Realtime</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Nama Peserta</th>
                            <th class="px-6 py-4 font-bold">Asal Instansi</th>
                            <th class="px-6 py-4 font-bold">Masuk</th>
                            <th class="px-6 py-4 font-bold">Pulang</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($attendancesGrouped as $date => $attendances)
                            <tr class="bg-slate-50/50">
                                <td colspan="5" class="px-6 py-3 text-xs font-black text-slate-900 uppercase tracking-[0.2em] bg-slate-100/80 border-y border-slate-200">
                                    🗓️ {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            @foreach($attendances as $attendance)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $attendance->user?->name ?? 'N/A' }}</div>
                                    @if($attendance->keterangan)
                                        <div class="text-[9px] text-blue-600 font-bold mt-0.5 italic leading-tight max-w-[200px]">{{ $attendance->keterangan }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-medium text-xs">
                                    {{ $attendance->user?->school ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-slate-600 font-bold text-xs">{{ $attendance->check_in_time ?? '—' }}</div>
                                    @if($attendance->check_in_time)
                                        @php
                                            $checkIn = \Carbon\Carbon::parse($attendance->check_in_time);
                                            $isLate = $checkIn->hour >= 9;
                                        @endphp
                                        @if($isLate)
                                            <span class="text-[8px] font-black text-rose-500 uppercase tracking-tighter">Terlambat</span>
                                        @else
                                            <span class="text-[8px] font-black text-emerald-500 uppercase tracking-tighter">Tepat Waktu</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-bold text-xs">
                                    {{ $attendance->check_out_time ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match($attendance->status) {
                                            'hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'izin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'sakit' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black border {{ $statusClass }} uppercase tracking-tighter">
                                        {{ $attendance->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <p class="text-3xl mb-2">📋</p>
                                    <p class="text-sm font-medium">Belum ada data absensi untuk periode ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
