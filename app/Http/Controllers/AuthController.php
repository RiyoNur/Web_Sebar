<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Tampilkan Form Login untuk Pembeli
    public function showBuyerLoginForm()
    {
        return view('auth.buyer_login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke halaman home setelah login berhasil
            return redirect()->intended(route('home'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Proses Login untuk Pembeli
    public function loginBuyer(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke halaman home pembeli setelah login berhasil
            return redirect()->intended(route('buyer.home'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Tampilkan Form Register untuk Pembeli
    public function showBuyerRegisterForm()
    {
        return view('auth.buyer_register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    // Proses Register untuk Pembeli
    public function registerBuyer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('buyer.login.form')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $redirectTo = $request->input('redirect_to', route('login.form'));
        return redirect($redirectTo);
    }
}
