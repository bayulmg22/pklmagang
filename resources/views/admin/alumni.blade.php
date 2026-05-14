<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? 'Alumni Magang' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-3">NIM/NISN</th>
                                    <th scope="col" class="px-6 py-3">Asal Instansi</th>
                                    <th scope="col" class="px-6 py-3">Nilai Akhir</th>
                                    <th scope="col" class="px-6 py-3">Predikat</th>
                                    <th scope="col" class="px-6 py-3">Tgl Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($interns as $intern)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $intern->name }}</td>
                                        <td class="px-6 py-4">{{ $intern->nim }}</td>
                                        <td class="px-6 py-4">{{ $intern->school }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900">
                                            {{ $intern->evaluation ? number_format($intern->evaluation->average, 1) : '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($intern->evaluation)
                                                @php
                                                    $pred = substr($intern->evaluation->predicate, 0, 1);
                                                    $color = match($pred) {
                                                        'A' => 'green',
                                                        'B' => 'blue',
                                                        'C' => 'yellow',
                                                        default => 'red'
                                                    };
                                                @endphp
                                                <span class="bg-{{ $color }}-100 text-{{ $color }}-800 text-xs font-medium px-2.5 py-0.5 rounded border border-{{ $color }}-300">
                                                    {{ $intern->evaluation->predicate }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $intern->evaluation && $intern->evaluation->finished_at ? \Carbon\Carbon::parse($intern->evaluation->finished_at)->format('d M Y') : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data alumni magang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
