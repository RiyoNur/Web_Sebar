<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
        Log::info('User  yang login:', [
            'email' => $user->email,
            'is_super_admin' => $user->is_super_admin,
        ]);

        if ($user->is_super_admin) {
            return $next($request);
        } else {
            Log::warning('User  tidak memiliki akses:', ['email' => $user->email]);
        }
    } else {
        Log::warning('User  tidak terautentikasi.');
    }

    return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses.');
}
}
