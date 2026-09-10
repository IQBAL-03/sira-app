<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class LetterRequestController extends Controller
{
    public function index()
    {
        $letters = LetterRequest::where('user_id', auth()->id())->latest()->get();
        return view('warga.surat.index', compact('letters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:1000',
        ]);

        LetterRequest::create([
            'user_id' => auth()->id(),
            'letter_type' => $request->letter_type,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan surat berhasil dikirim. Mohon tunggu verifikasi admin.');
    }

    public function downloadPdf(LetterRequest $letter)
    {
        // Pastikan hanya pemilik surat dan yang berstatus approved yang bisa download
        if ($letter->user_id !== auth()->id() || $letter->status !== 'approved') {
            abort(403, 'Akses tidak diizinkan atau surat belum disetujui.');
        }

        $letter->load('user');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.pdf', compact('letter'))
            ->setPaper('a4', 'portrait');
            
        $filename = 'surat_pengantar_' . $letter->id . '_' . \Illuminate\Support\Str::slug($letter->user->name ?? 'warga') . '.pdf';
        return $pdf->download($filename);
    }
}
