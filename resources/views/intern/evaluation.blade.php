<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Penilaian Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8">
                <div class="text-center mb-8 border-b pb-6">
                    <h3 class="text-3xl font-extrabold text-gray-900 uppercase">Sertifikat Kelulusan Magang</h3>
                    <p class="text-gray-500 mt-2">Dinas Sosial Kabupaten Lamongan</p>
                </div>

                <div class="mb-8">
                    <table class="w-full text-left text-gray-700">
                        <tr>
                            <th class="py-2 w-1/3">Nama Peserta</th>
                            <td class="py-2 font-bold">: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="py-2">NIM / NISN</th>
                            <td class="py-2 font-bold">: {{ $user->nim }}</td>
                        </tr>
                        <tr>
                            <th class="py-2">Asal Sekolah / Kampus</th>
                            <td class="py-2 font-bold">: {{ $user->school }}</td>
                        </tr>
                    </table>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Rincian Nilai</h4>
                    <div class="grid grid-cols-2 gap-y-3 text-sm">
                        <div class="font-medium text-gray-600">Kedisiplinan</div>
                        <div class="font-bold text-right">{{ $evaluation->kedisiplinan }}</div>
                        
                        <div class="font-medium text-gray-600">Tanggung Jawab</div>
                        <div class="font-bold text-right">{{ $evaluation->tanggung_jawab }}</div>
                        
                        <div class="font-medium text-gray-600">Kerja Sama Tim</div>
                        <div class="font-bold text-right">{{ $evaluation->kerja_sama }}</div>
                        
                        <div class="font-medium text-gray-600">Kreativitas</div>
                        <div class="font-bold text-right">{{ $evaluation->kreativitas }}</div>
                        
                        <div class="font-medium text-gray-600">Kemampuan Beradaptasi</div>
                        <div class="font-bold text-right">{{ $evaluation->kemampuan_beradaptasi }}</div>
                        
                        <div class="font-medium text-gray-600">Kualitas Hasil Kerja</div>
                        <div class="font-bold text-right">{{ $evaluation->kualitas_hasil_kerja }}</div>
                        
                        <div class="font-medium text-gray-600">Penyusunan Laporan</div>
                        <div class="font-bold text-right">{{ $evaluation->penyusunan_laporan }}</div>
                        
                        <div class="col-span-2 border-t mt-2 pt-2"></div>
                        
                        <div class="font-bold text-gray-800 text-lg">Nilai Rata-rata</div>
                        <div class="font-bold text-blue-600 text-xl text-right">{{ $evaluation->average }}</div>
                        
                        <div class="font-bold text-gray-800 text-lg">Predikat</div>
                        <div class="font-bold text-green-600 text-xl text-right">{{ $evaluation->predicate }}</div>
                    </div>
                </div>

                <div class="mb-8">
                    <h4 class="font-bold text-gray-800 mb-2">Komentar & Pesan Pembimbing:</h4>
                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 italic text-gray-700">
                        "{{ $evaluation->comments }}"
                    </div>
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('intern.evaluation.print') }}" target="_blank" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                        Cetak Laporan Penilaian (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
