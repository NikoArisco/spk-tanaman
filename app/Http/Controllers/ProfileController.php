<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna.
     */
    public function show(): View
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Update data profil dan password pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
        ];

        // Jika mengisi password baru, lakukan validasi password
        if ($request->filled('password')) {
            $rules['current_password'] = ['required', 'string'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $request->validate($rules);

        // Cek kecocokan password lama jika mencoba mengganti password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password saat ini yang Anda masukkan tidak cocok.',
                ])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
