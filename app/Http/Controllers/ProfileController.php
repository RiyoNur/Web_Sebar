<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan halaman akun
    // ProfileController.php

public function edit()
{
    // Menampilkan halaman profil pengguna
    return view('akun');
}

public function update(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|confirmed|min:8',
    ]);

    // Update data pengguna
    $user = auth()->user();
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    if ($request->password) {
        $user->password = bcrypt($validated['password']);
    }

    $user->save();

    return redirect()->route('akun')->with('success', 'Profil berhasil diperbarui!');
}

}
