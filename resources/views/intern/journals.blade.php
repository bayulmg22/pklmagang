<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurnal Kegiatan Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Form Input -->
                @if(auth()->user()->status === 'approved')
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Input Jurnal Baru</h3>
                        <p class="text-sm text-gray-500 mb-4">Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        
                        <form action="{{ route('intern.journals.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="activity" class="block text-sm font-medium text-gray-700 mb-1">Kegiatan / Aktivitas</label>
                                <textarea name="activity" id="activity" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm" required placeholder="Contoh: Membantu rekap data bansos..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti (Opsional)</label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none p-2">
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">Simpan Jurnal</button>
                        </form>
                    </div>
                </div>
                @endif

                <!-- List Jurnal -->
                <div class="{{ auth()->user()->status === 'approved' ? 'md:col-span-2' : 'md:col-span-3' }}">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Jurnal Anda</h3>
                            <a href="{{ route('intern.journals.print') }}" target="_blank" class="px-3 py-1 bg-gray-800 text-white rounded hover:bg-gray-700 transition text-sm">
                                🖨️ Cetak PDF
                            </a>
                        </div>
                        
                        <div class="space-y-6">
                            @forelse($journals as $journal)
                                <div class="flex gap-4 p-4 border rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold">
                                            {{ \Carbon\Carbon::parse($journal->date)->format('d') }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('l, d F Y') }}</h4>
                                            <span class="text-xs text-gray-500">{{ $journal->created_at->format('H:i') }}</span>
                                        </div>
                                        <p class="text-gray-700 mt-2 whitespace-pre-wrap">{{ $journal->activity }}</p>
                                        
                                        @if($journal->photo_path)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $journal->photo_path) }}" alt="Bukti" class="h-32 w-auto rounded-lg border object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 text-gray-500">
                                    <div class="text-4xl mb-3">📭</div>
                                    <p>Belum ada jurnal kegiatan yang dicatat.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
