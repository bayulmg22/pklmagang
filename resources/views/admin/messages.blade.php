<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pesan & Pengumuman') }}
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Kirim pesan personal atau pengumuman ke seluruh peserta magang.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-sm font-semibold shadow-sm flex items-center gap-3">
                <div class="p-1 bg-emerald-100 text-emerald-600 rounded-full">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40 overflow-hidden">
            <div class="border-b border-slate-50 px-8 py-6 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 text-lg">Buat Pesan Baru</h3>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.messages.store') }}" method="POST" class="space-y-6 max-w-3xl">
                    @csrf
                    
                    <div x-data="{ type: 'announcement' }">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="announcement" x-model="type" class="sr-only peer">
                                <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/20 shadow-sm flex items-center gap-3">
                                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-sm">Pengumuman</h4>
                                        <p class="text-xs text-slate-500">Kirim ke semua peserta aktif</p>
                                    </div>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="message" x-model="type" class="sr-only peer">
                                <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/20 shadow-sm flex items-center gap-3">
                                    <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-sm">Pesan Pribadi</h4>
                                        <p class="text-xs text-slate-500">Kirim ke peserta tertentu</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- User Selection (Only visible for 'message' type) -->
                        <div x-show="type === 'message'" class="mb-6 animate-fade" style="display: none;">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilih Peserta <span class="text-rose-500">*</span></label>
                            <select name="user_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all" x-bind:required="type === 'message'">
                                <option value="">-- Pilih Peserta --</option>
                                @foreach($interns as $intern)
                                    <option value="{{ $intern->id }}">{{ $intern->name }} ({{ $intern->nim }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul / Subjek <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" required placeholder="Contoh: Info Rapat Koordinasi" 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Pesan <span class="text-rose-500">*</span></label>
                        <textarea name="message" rows="5" required placeholder="Ketik pesan Anda di sini..."
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/30">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0 1 21.485 12 59.77 59.77 0 0 1 3.27 20.876L5.999 12Zm0 0h7.5" />
                            </svg>
                            Kirim Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
