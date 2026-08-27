<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index()
    {
        $warga = User::where('role', 'warga')->latest()->get();
        return view('admin.warga.index', compact('warga'));
    }

    public function edit(User $user)
    {
        return view('admin.warga.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nik' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'phone.required' => 'No. telepon wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
        ]);

        $user->update($request->only([
            'name', 'email', 'nik', 'phone', 'address'
        ]));

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function verify(User $user)
    {
        $user->is_verified = !$user->is_verified;
        $user->save();
        $msg = $user->is_verified ? 'Akun warga berhasil diverifikasi.' : 'Verifikasi akun warga dibatalkan.';
        return back()->with('success', $msg);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Data warga berhasil dihapus.');
    }
}
