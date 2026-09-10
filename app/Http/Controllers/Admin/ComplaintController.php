<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('complaints'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate(['status' => 'required|in:pending,process,resolved']);
        $complaint->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function export()
    {
        $complaints = Complaint::with('user')->latest()->get();

        // Siapkan foto dalam format base64 agar aman dan langsung tampil di DomPDF
        foreach ($complaints as $complaint) {
            $complaint->photo_base64 = null;
            if ($complaint->photo) {
                try {
                    // Jika path lokal storage
                    if (str_contains($complaint->photo, '/storage/')) {
                        $relativePath = str_replace(asset('storage') . '/', '', $complaint->photo);
                        $fullPath = storage_path('app/public/' . $relativePath);
                        if (file_exists($fullPath)) {
                            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                            $data = file_get_contents($fullPath);
                            $complaint->photo_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        }
                    } elseif (filter_var($complaint->photo, FILTER_VALIDATE_URL)) {
                        // Jika URL eksternal (misal Cloudinary)
                        $ctx = stream_context_create([
                            'http' => ['timeout' => 3],
                            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
                        ]);
                        $data = @file_get_contents($complaint->photo, false, $ctx);
                        if ($data !== false) {
                            $complaint->photo_base64 = 'data:image/jpeg;base64,' . base64_encode($data);
                        }
                    }
                } catch (\Exception $e) {
                    $complaint->photo_base64 = null;
                }
            }
        }
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pengaduan.pdf', compact('complaints'))
            ->setPaper('a4', 'landscape')
            ->setOption('isRemoteEnabled', true);
            
        $filename = 'laporan_pengaduan_' . date('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }
}
