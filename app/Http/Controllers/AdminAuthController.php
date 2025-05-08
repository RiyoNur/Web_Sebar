<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register'); // Tampilkan view untuk registrasi
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_super_admin' => true, // Set this according to your needs
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin berhasil terdaftar.');
    }

    public function showLoginForm()
    {
        return view('admin.login'); // Tampilkan view untuk login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial dengan guard admin
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('admin')->user(); // Ambil user yang terautentikasi
            Log::info('Login berhasil untuk user:', ['email' => $user->email]);

            // Periksa apakah user adalah super admin
            if ($user->is_super_admin) {
                return redirect()->route('admin.dashboard'); // Rute dashboard admin
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses.');
            }
        }

        Log::warning('Login gagal untuk user:', ['email' => $request->email]);
        return redirect()->back()->with('error', 'Kredensial salah.');
    }

    // Proses Logout untuk Admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
