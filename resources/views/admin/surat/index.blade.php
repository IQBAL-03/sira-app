<x-app-layout>
    <x-slot name="title">Manajemen Surat Pengantar</x-slot>

    <div class="space-y-5">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Surat Pengantar</h3>
            <p class="text-slate-500 text-sm">Tinjau, setujui, tolak, dan cetak surat pengantar warga.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Pemohon</th>
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
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-800">{{ $letter->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-slate-500">NIK: {{ $letter->user->nik ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">{{ $letter->letter_type }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 max-w-48">
                                    <p class="text-xs line-clamp-2">{{ $letter->purpose }}</p>
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">{{ $letter->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $letter->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($letter->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $letter->status === 'pending' ? 'Pending' : ($letter->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if($letter->status === 'pending')
                                            <form action="{{ route('admin.surat.status', $letter) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-green-100 text-green-700 hover:bg-green-200 transition-all">Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.surat.status', $letter) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-100 text-red-700 hover:bg-red-200 transition-all">Tolak</button>
                                            </form>
                                        @endif
                                        @if($letter->status === 'approved')
                                            <a href="{{ route('admin.surat.pdf', $letter) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 transition-all flex items-center gap-1.5 shadow-sm" title="Unduh PDF">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Unduh PDF
                                            </a>
                                        @endif
                                        @if($letter->status !== 'pending')
                                            <form action="{{ route('admin.surat.status', $letter) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-amber-100 text-amber-700 hover:bg-amber-200 transition-all">Reset</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Belum ada pengajuan surat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
