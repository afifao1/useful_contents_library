<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Foydalanuvchi allaqachon autentifikatsiyadan o‘tsa, uni qayta yo‘naltiradi.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);  // HOME URL'ni o'zingizga moslang
        }

        return $next($request);
    }
}
