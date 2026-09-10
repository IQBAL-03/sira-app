<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class LetterRequestController extends Controller
{
    public function index()
    {
        $letters = LetterRequest::with('user')->latest()->get();
        return view('admin.surat.index', compact('letters'));
    }

    public function updateStatus(Request $request, LetterRequest $letter)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $letter->update(['status' => $request->status]);
        return back()->with('success', 'Status surat berhasil diperbarui.');
    }

    public function print(LetterRequest $letter)
    {
        $letter->load('user');
        return view('admin.surat.print', compact('letter'));
    }

    public function downloadPdf(LetterRequest $letter)
    {
        $letter->load('user');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.surat.pdf', compact('letter'))
            ->setPaper('a4', 'portrait');
            
        $filename = 'surat_pengantar_' . $letter->id . '_' . \Illuminate\Support\Str::slug($letter->user->name ?? 'warga') . '.pdf';
        return $pdf->download($filename);
    }
}
