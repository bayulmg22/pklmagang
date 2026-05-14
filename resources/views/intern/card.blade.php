<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cetak ID Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col md:flex-row gap-8">
                    
                    <!-- Form Upload Foto -->
                    <div class="flex-1">
                        <h3 class="text-lg font-bold mb-4">Lengkapi Foto Profil</h3>
                        <p class="text-sm text-gray-600 mb-6">Sebelum mencetak ID Card, pastikan Anda telah mengunggah foto profil resmi. Foto ini akan dicetak pada Kartu Magang Anda.</p>
                        
                        @if(session('success'))
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Foto Resmi (Maks 2MB)</label>
                                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                                @error('photo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Simpan Foto</button>
                        </form>

                        <div class="mt-8 pt-8 border-t">
                            <h3 class="text-lg font-bold mb-4">Cetak Kartu</h3>
                            <a href="{{ route('intern.card.print') }}" target="_blank" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-lg">
                                Cetak ID Card (PDF)
                            </a>
                        </div>
                    </div>

                    <!-- Preview ID Card Mini -->
                    <div class="w-full md:w-80 flex flex-col items-center border rounded-xl p-6 bg-gray-50 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-24 bg-blue-600"></div>
                        
                        <!-- Logo & Header -->
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fc/Lambang_Kabupaten_Lamongan.png" class="h-12 mb-2 bg-white rounded-full p-1 shadow">
                            <h4 class="text-white font-bold text-sm">DINAS SOSIAL</h4>
                            <p class="text-blue-100 text-xs mb-6">KAB. LAMONGAN</p>
                            
                            <!-- Foto -->
                            <div class="w-28 h-36 bg-white shadow-md border-4 border-white mb-4 overflow-hidden rounded">
                                @if(auth()->user()->photo_path)
                                    <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-sm text-center p-2">
                                        Belum Ada Foto
                                    </div>
                                @endif
                            </div>

                            <h2 class="text-lg font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-sm text-blue-600 font-semibold">{{ auth()->user()->nim }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->school }}</p>
                            
                            <!-- QR Code Placeholder -->
                            <div class="mt-6 border p-1 bg-white inline-block rounded">
                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate(auth()->user()->id . '-' . auth()->user()->nim) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
