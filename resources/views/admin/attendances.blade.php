<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pantau Absensi') }}
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
                                    <th scope="col" class="px-6 py-3">Nama Peserta</th>
                                    <th scope="col" class="px-6 py-3">Asal Instansi</th>
                                    <th scope="col" class="px-6 py-3">Jam Masuk</th>
                                    <th scope="col" class="px-6 py-3">Jam Pulang</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendancesGrouped as $date => $attendances)
                                    <tr class="bg-gray-100">
                                        <td colspan="5" class="px-6 py-2 font-bold text-gray-700">Tanggal: {{ $date }}</td>
                                    </tr>
                                    @foreach($attendances as $attendance)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $attendance->user?->name ?? 'User Dihapus' }}</td>
                                        <td class="px-6 py-4">{{ $attendance->user?->school ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $attendance->check_in_time ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $attendance->check_out_time ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if($attendance->status == 'hadir')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-300">Hadir</span>
                                            @elseif($attendance->status == 'telat')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-300">Telat</span>
                                            @elseif($attendance->status == 'izin')
                                                <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded border border-orange-300">Izin</span>
                                            @elseif($attendance->status == 'sakit')
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-300">Sakit</span>
                                            @else
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-300">{{ ucfirst($attendance->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi.</td>
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
