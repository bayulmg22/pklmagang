<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest mb-4">Foto Profil</h3>
                    <form action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-6">
                        @csrf
                        <div class="w-20 h-20 rounded-2xl bg-slate-100 overflow-hidden shadow-inner border border-slate-200">
                            @if(auth()->user()->photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-2xl text-slate-300">👤</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label for="profilePhotoInput" class="inline-block px-4 py-2 bg-slate-900 text-white text-[10px] font-black rounded-lg cursor-pointer hover:bg-blue-600 transition-all uppercase tracking-widest">
                                Ganti Foto
                            </label>
                            <input id="profilePhotoInput" type="file" name="photo" class="hidden" onchange="this.form.submit()">
                            <p class="text-[10px] text-slate-400 font-bold mt-2 italic">Format: JPG, PNG (Maks 2MB). Foto akan langsung terupdate.</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
