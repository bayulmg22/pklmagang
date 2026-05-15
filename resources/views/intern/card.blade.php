<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('ID Card Magang') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Settings -->
        <div class="lg:col-span-7 space-y-6">
            <div class="content-card p-6">
                <h3 class="font-bold text-slate-800 mb-4">Pengaturan Kartu</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Unggah foto profil terbaru Anda untuk dicetak pada kartu magang. Pastikan wajah terlihat jelas dengan pencahayaan yang cukup.
                </p>

                @if(session('success'))
                    <div class="p-4 mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form id="photoForm" action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="relative group">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Pilih Foto Profil (Maks 2MB)</label>
                        <div class="flex items-center gap-4">
                            <label for="photoInput" class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-2xl py-8 px-4 hover:border-blue-600 hover:bg-blue-50 transition-all cursor-pointer bg-slate-50">
                                <span class="text-2xl mb-2">📸</span>
                                <span class="text-xs font-black text-slate-600 uppercase tracking-widest">Klik untuk ganti foto</span>
                                <input id="photoInput" type="file" name="photo" accept="image/*" class="hidden" onchange="previewAndSubmit(this)">
                            </label>
                        </div>
                        @error('photo')
                            <p class="text-red-500 text-[10px] font-black mt-2 uppercase tracking-tight">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 italic">Sistem akan menyimpan foto secara otomatis setelah Anda memilih file.</p>
                </form>

                <script>
                    function previewAndSubmit(input) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // Update preview immediately
                                const preview = document.getElementById('cardPhotoPreview');
                                if (preview) {
                                    preview.src = e.target.result;
                                    preview.classList.remove('hidden');
                                    const placeholder = document.getElementById('cardPhotoPlaceholder');
                                    if (placeholder) placeholder.classList.add('hidden');
                                }
                            }
                            reader.readAsDataURL(input.files[0]);
                            
                            // Auto submit after short delay to show preview
                            setTimeout(() => {
                                document.getElementById('photoForm').submit();
                            }, 500);
                        }
                    }
                </script>
            </div>

            <div class="content-card p-8 bg-blue-600 text-white border-0 shadow-lg shadow-blue-200">
                <h4 class="text-xl font-bold mb-2">Cetak Kartu Fisik</h4>
                <p class="text-blue-100 text-sm mb-6 leading-relaxed">Kartu magang Anda dapat diunduh dalam format PDF. Kartu ini digunakan untuk identitas resmi dan scan kehadiran di kantor Dinas Sosial.</p>
                <a href="{{ route('intern.card.print') }}" target="_blank" 
                   class="inline-flex items-center gap-2 px-8 py-3 bg-white text-blue-600 rounded-xl font-bold text-sm shadow-xl hover:bg-blue-50 transition active:translate-y-0.5">
                    🖨️ Cetak ID Card (PDF)
                </a>
            </div>
        </div>

        <!-- Right Column: Card Preview -->
        <div class="lg:col-span-5 flex flex-col items-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8">Pratinjau Kartu Resmi</p>
            
            {{-- Professional ID Card Design (Mirroring PDF Layout) --}}
            <div class="w-[300px] h-[450px] bg-white rounded-2xl shadow-2xl border border-slate-100 flex flex-col overflow-hidden relative">
                <!-- Header (Slate 900) - Matching PDF style -->
                <div class="bg-[#0f172a] text-center py-5 border-b-[3px] border-blue-600 px-2">
                    <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto mx-auto mb-2 bg-white p-0.5 rounded-sm" alt="Logo">
                    <h5 class="text-white font-black text-sm tracking-tight leading-none">DINAS SOSIAL</h5>
                    <p class="text-blue-400 text-[8px] font-black uppercase tracking-widest mt-1">Kabupaten Lamongan</p>
                </div>

                <!-- Content Area -->
                <div class="flex-1 flex flex-col items-center pt-5 px-4 text-center">
                    <!-- Photo Frame -->
                    <div class="w-[110px] h-[145px] bg-slate-50 border-[3px] border-slate-100 overflow-hidden relative shadow-sm">
                        @if(auth()->user()->photo_path)
                            <img id="cardPhotoPreview" src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                        @else
                            <img id="cardPhotoPreview" class="w-full h-full object-cover hidden">
                            <div id="cardPhotoPlaceholder" class="w-full h-full flex items-center justify-center text-4xl text-slate-200">👤</div>
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="mt-2 space-y-0.5">
                        <h2 class="text-base font-black text-slate-900 uppercase leading-tight">{{ auth()->user()->name }}</h2>
                        <p class="text-blue-600 font-black text-xs">{{ auth()->user()->nim }}</p>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ auth()->user()->school }}</p>
                    </div>
                </div>

                <!-- QR Section (Absolute Bottom like PDF) -->
                <div class="absolute bottom-5 w-full text-center">
                    <div class="inline-block p-1.5 bg-white border border-slate-50 shadow-sm rounded-lg mb-1">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(65)->generate(route('attendance.scan', auth()->user())) !!}
                    </div>
                    <div class="text-[6px] font-black text-slate-400 uppercase tracking-widest">Dicetak: {{ now()->locale('id')->translatedFormat('d F Y') }}</div>
                </div>

                <!-- Footer Strip -->
                <div class="absolute bottom-0 w-full h-2.5 bg-[#0f172a]"></div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
