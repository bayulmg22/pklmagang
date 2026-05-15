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
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Preview Kartu Digital</p>
            
            {{-- Professional ID Card Layout --}}
            <div class="w-[300px] h-[480px] bg-white rounded-[2rem] shadow-2xl border border-slate-100 flex flex-col overflow-hidden relative">
                <!-- Blue Header Banner -->
                <div class="h-32 bg-slate-900 flex flex-col items-center justify-center text-center p-6">
                    <div class="bg-white p-1.5 rounded-xl shadow-sm mb-3">
                        <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto" alt="Logo">
                    </div>
                    <h5 class="text-white font-black text-base tracking-tight leading-none">DINAS SOSIAL</h5>
                    <p class="text-sky-400 text-[10px] font-black uppercase tracking-[0.2em] mt-1.5">Kab. Lamongan</p>
                </div>

                <!-- Profile Section -->
                <div class="flex-1 flex flex-col items-center px-6 pt-12 text-center">
                    <!-- Photo Box -->
                    <div class="w-32 h-40 bg-white border-[6px] border-white shadow-2xl rounded-2xl overflow-hidden -mt-24 z-10">
                        @if(auth()->user()->photo_path)
                            <img id="cardPhotoPreview" src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                        @else
                            <img id="cardPhotoPreview" class="w-full h-full object-cover hidden">
                            <div id="cardPhotoPlaceholder" class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                                <span class="text-4xl">👤</span>
                            </div>
                        @endif
                    </div>

                    <!-- Name & ID -->
                    <div class="mt-8 space-y-2">
                        <h2 class="text-xl font-black text-slate-900 leading-tight uppercase tracking-tighter">{{ auth()->user()->name }}</h2>
                        <p class="text-blue-600 font-black text-sm tracking-widest">{{ auth()->user()->nim }}</p>
                        <div class="pt-4">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] mb-1">{{ auth()->user()->school }}</p>
                            <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-[9px] font-black rounded-full uppercase tracking-widest border border-blue-100">Internship Member</span>
                        </div>
                    </div>

                    <!-- QR Area -->
                    <div class="mt-auto mb-10">
                        <div class="p-2 bg-white border border-slate-50 shadow-sm rounded-2xl inline-block">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate(auth()->user()->id . '-' . auth()->user()->nim) !!}
                        </div>
                        <p class="text-[8px] font-black text-slate-300 mt-3 tracking-[0.3em] uppercase">Simasos Official Pass</p>
                    </div>
                </div>

                <!-- Footer Strip -->
                <div class="h-2 bg-blue-600"></div>
            </div>
        </div>
    </div>
</x-app-layout>
