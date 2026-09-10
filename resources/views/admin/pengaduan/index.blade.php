<x-app-layout>
    <x-slot name="title">Manajemen Pengaduan</x-slot>

    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Pengaduan Warga</h3>
                <p class="text-slate-500 text-sm">Tinjau dan perbarui status pengaduan warga.</p>
            </div>
            <a href="{{ route('admin.pengaduan.export') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Laporan (PDF)
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Pelapor</th>
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Judul & Deskripsi</th>
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Foto</th>
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Status</th>
                            <th
                                class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">
                                Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($complaints as $complaint)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-800">{{ $complaint->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-slate-500">{{ $complaint->user->phone ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 max-w-56">
                                    <p class="font-medium text-slate-800 text-sm">{{ $complaint->title }}</p>
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $complaint->description }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($complaint->photo_url)
                                        <a href="{{ $complaint->photo_url }}" target="_blank" class="inline-block">
                                            <img src="{{ $complaint->photo_url }}"
                                                class="w-16 h-16 object-cover rounded-lg border border-slate-200 hover:opacity-80 transition-opacity cursor-pointer shadow-sm"
                                                alt="Foto Bukti"
                                                loading="lazy">
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">{{ $complaint->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                            {{ $complaint->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($complaint->status === 'process' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                        {{ $complaint->status === 'pending' ? 'Pending' : ($complaint->status === 'process' ? 'Diproses' : 'Selesai') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.pengaduan.status', $complaint) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <select name="status"
                                            class="border-slate-300 rounded-lg text-xs py-1.5 focus:ring-red-500 focus:border-red-500">
                                            <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="process" {{ $complaint->status === 'process' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs font-medium hover:bg-red-700 transition-all">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Belum ada pengaduan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>