<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="photo" :value="__('Foto Profil')" />
            <div class="mt-4 flex flex-col sm:flex-row items-center gap-6">
                <!-- Current Photo Preview -->
                <div class="relative group">
                    <div class="w-24 h-24 rounded-2xl bg-slate-100 overflow-hidden shadow-inner border-2 border-white ring-1 ring-slate-200">
                        @if($user->photo_path)
                            <img id="photo_preview" src="{{ asset('storage/' . $user->photo_path) }}?t={{ time() }}" alt="Foto" class="w-full h-full object-cover">
                        @else
                            <div id="photo_placeholder" class="w-full h-full flex items-center justify-center text-4xl text-slate-300">👤</div>
                            <img id="photo_preview" src="" alt="Foto" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                </div>

                <!-- Upload Button -->
                <div class="flex-1 w-full sm:w-auto text-center sm:text-left">
                    <label for="photo_input" class="inline-flex items-center px-4 py-2 bg-slate-900 border border-transparent rounded-lg font-black text-[10px] text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pilih Foto Baru
                    </label>
                    <input id="photo_input" name="photo" type="file" accept="image/*" class="hidden" onchange="previewImage(this)" />
                    <p class="mt-2 text-[10px] text-slate-500 font-medium italic">Format: JPG, PNG (Maks 5MB)</p>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>
            </div>
            
            <script>
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var preview = document.getElementById('photo_preview');
                            var placeholder = document.getElementById('photo_placeholder');
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            if (placeholder) placeholder.classList.add('hidden');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
