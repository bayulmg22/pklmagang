<section class="space-y-6">

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2.5 bg-rose-600 text-white font-bold rounded-xl text-xs uppercase tracking-wider hover:bg-rose-700 transition shadow-sm active:translate-y-0.5"
    >Hapus Akun Permanen</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6 space-y-1">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all font-medium text-slate-700"
                    placeholder="{{ __('Masukkan kata sandi Anda untuk konfirmasi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs uppercase tracking-wider hover:bg-slate-200 transition">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2.5 bg-rose-600 text-white font-bold rounded-xl text-xs uppercase tracking-wider hover:bg-rose-700 transition shadow-sm active:translate-y-0.5">
                    Ya, Hapus Akun Saya
                </button>
            </div>
        </form>
    </x-modal>
</section>
