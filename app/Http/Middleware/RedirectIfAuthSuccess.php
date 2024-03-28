<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthSuccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek jika admin yang login
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->hasRole('mentor')) {
                return redirect(RouteServiceProvider::MENTOR_DASHBOARD); // jika role mentor redirect dashboard mentor
            } else {
                return redirect(RouteServiceProvider::ADMIN_DASHBOARD); // selain role mentor redirect dashboard admin
            }
        } elseif (Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME); // jika user yang login redirect ke home
        }

        return $next($request);
    }
}
