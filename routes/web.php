<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\LetterRequestController as AdminLetterController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DueController as AdminDueController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\LetterRequestController as WargaLetterController;
use App\Http\Controllers\Warga\ComplaintController as WargaComplaintController;
use App\Http\Controllers\Warga\DueController as WargaDueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('warga.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/{user}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::patch('/warga/{user}', [WargaController::class, 'update'])->name('warga.update');
    Route::patch('/warga/{user}/verify', [WargaController::class, 'verify'])->name('warga.verify');
    Route::delete('/warga/{user}', [WargaController::class, 'destroy'])->name('warga.destroy');

    Route::get('/surat', [AdminLetterController::class, 'index'])->name('surat.index');
    Route::patch('/surat/{letter}/status', [AdminLetterController::class, 'updateStatus'])->name('surat.status');
    Route::get('/surat/{letter}/print', [AdminLetterController::class, 'print'])->name('surat.print');
    Route::get('/surat/{letter}/pdf', [AdminLetterController::class, 'downloadPdf'])->name('surat.pdf');

    Route::get('/pengaduan', [AdminComplaintController::class, 'index'])->name('pengaduan.index');
    Route::patch('/pengaduan/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])->name('pengaduan.status');
    Route::get('/pengaduan/export', [AdminComplaintController::class, 'export'])->name('pengaduan.export');

    Route::get('/iuran', [AdminDueController::class, 'index'])->name('iuran.index');
    Route::post('/iuran', [AdminDueController::class, 'store'])->name('iuran.store');
    Route::patch('/iuran/{due}/status', [AdminDueController::class, 'updateStatus'])->name('iuran.status');
    Route::delete('/iuran/{due}', [AdminDueController::class, 'destroy'])->name('iuran.destroy');
});

Route::middleware(['auth', 'verified', 'role:warga', 'verified.warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');

    Route::get('/surat', [WargaLetterController::class, 'index'])->name('surat.index');
    Route::post('/surat', [WargaLetterController::class, 'store'])->name('surat.store');
    Route::get('/surat/{letter}/pdf', [WargaLetterController::class, 'downloadPdf'])->name('surat.pdf');

    Route::get('/pengaduan', [WargaComplaintController::class, 'index'])->name('pengaduan.index');
    Route::post('/pengaduan', [WargaComplaintController::class, 'store'])->name('pengaduan.store');

    Route::get('/iuran', [WargaDueController::class, 'index'])->name('iuran.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
