<x-app-layout>
    <x-slot name="title">Edit Data Warga</x-slot>

    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.warga.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Data Warga
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Edit Data Warga</h3>

            <form action="{{ route('admin.warga.update', $user) }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                        <x-text-input name="name" class="w-full" required value="{{ old('name', $user->name) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">NIK</label>
                        <x-text-input name="nik" class="w-full" required value="{{ old('nik', $user->nik) }}" />
                        <x-input-error :messages="$errors->get('nik')" class="mt-1" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <x-text-input name="email" type="email" class="w-full" required value="{{ old('email', $user->email) }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">No. Telepon</label>
                        <x-text-input name="phone" class="w-full" required value="{{ old('phone', $user->phone) }}" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required placeholder="Jl. Contoh No. 1, RT 01/RW 02..." class="w-full border-slate-300 rounded-lg text-sm focus:ring-red-500 focus:border-red-500 resize-none">{{ old('address', $user->address) }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <x-primary-button>Simpan Perubahan</x-primary-button>
                    <a href="{{ route('admin.warga.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
