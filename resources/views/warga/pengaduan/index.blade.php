<x-app-layout>
    <x-slot name="title">Pengaduan Warga</x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Layanan Pengaduan</h3>
            <p class="text-slate-500 text-sm">Sampaikan laporan atau keluhan terkait lingkungan RT/RW.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h4 class="font-semibold text-slate-800 mb-4">Buat Laporan Baru</h4>
                    <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Laporan</label>
                            <x-text-input name="title" class="w-full" required placeholder="Cth: Lampu jalan mati" />
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Detail</label>
                            <textarea name="description" rows="4" required class="w-full border-slate-300 rounded-lg text-sm focus:ring-red-500 focus:border-red-500 resize-none" placeholder="Jelaskan detail lokasi dan masalah..."></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Foto Bukti (Opsional)</label>
                            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all"/>
                            <p class="text-xs text-slate-400 mt-1">Maks. 2MB (JPG, PNG, WEBP)</p>
                            <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                        </div>
                        <x-primary-button class="w-full justify-center">Kirim Laporan</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-4">
                <h4 class="font-semibold text-slate-800 px-1">Feed Pengaduan Saya</h4>
                
                @forelse($complaints as $complaint)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col sm:flex-row">
                        @if($complaint->photo_url)
                            <div class="sm:w-48 h-48 sm:h-auto flex-shrink-0">
                                <img src="{{ $complaint->photo_url }}" class="w-full h-full object-cover" alt="Foto Bukti">
                            </div>
                        @else
                            <div class="sm:w-48 h-32 sm:h-auto bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between mb-2">
                                    <h5 class="font-bold text-slate-800">{{ $complaint->title }}</h5>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold whitespace-nowrap ml-2
                                        {{ $complaint->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($complaint->status === 'process' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                        {{ $complaint->status === 'pending' ? 'Pending' : ($complaint->status === 'process' ? 'Diproses' : 'Selesai') }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600 line-clamp-3 mb-4">{{ $complaint->description }}</p>
                            </div>
                            <div class="flex items-center justify-between mt-4 text-xs text-slate-400 border-t border-slate-100 pt-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $complaint->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
                        <svg class="w-12 h-12 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        <p class="text-slate-500 text-sm">Belum ada riwayat pengaduan yang Anda buat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
