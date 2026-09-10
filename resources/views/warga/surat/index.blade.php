<x-app-layout>
    <x-slot name="title">Pengajuan Surat Pengantar</x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Surat Pengantar</h3>
            <p class="text-slate-500 text-sm">Ajukan surat pengantar ke RT/RW secara online.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h4 class="font-semibold text-slate-800 mb-4">Buat Pengajuan Baru</h4>
                    <form action="{{ route('warga.surat.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Surat</label>
                            <select name="letter_type" required class="w-full border-slate-300 rounded-lg text-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="Pengantar KTP">Pengantar KTP</option>
                                <option value="Pengantar SKCK">Pengantar SKCK</option>
                                <option value="Keterangan Domisili">Keterangan Domisili</option>
                                <option value="Keterangan Kelahiran">Keterangan Kelahiran</option>
                                <option value="Keterangan Kematian">Keterangan Kematian</option>
                                <option value="Keterangan Tidak Mampu (SKTM)">Keterangan Tidak Mampu (SKTM)</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('letter_type')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Keperluan / Alasan</label>
                            <textarea name="purpose" rows="4" required class="w-full border-slate-300 rounded-lg text-sm focus:ring-red-500 focus:border-red-500 resize-none" placeholder="Jelaskan keperluan pembuatan surat secara singkat..."></textarea>
                            <x-input-error :messages="$errors->get('purpose')" class="mt-1" />
                        </div>
                        <x-primary-button class="w-full justify-center">Kirim Pengajuan</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h4 class="font-semibold text-slate-800">Riwayat Pengajuan Saya</h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Jenis Surat</th>
                                    <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Keperluan</th>
                                    <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Tanggal</th>
                                    <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Status</th>
                                    <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($letters as $letter)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-slate-800">{{ $letter->letter_type }}</td>
                                        <td class="px-6 py-4 text-slate-600 max-w-xs truncate">{{ $letter->purpose }}</td>
                                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $letter->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                                {{ $letter->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($letter->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                                {{ $letter->status === 'pending' ? 'Pending' : ($letter->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($letter->status === 'approved')
                                                <a href="{{ route('warga.surat.pdf', $letter) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 transition-all shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                    Unduh PDF
                                                </a>
                                            @else
                                                <span class="text-slate-400 text-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Belum ada riwayat pengajuan surat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
