<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('staff')->check()) {
            if (auth('staff')->user()->status == 'active') {
                return $next($request);
            } else {
                switch (auth('staff')->user()->status) {
                    case 'inactive':
                        Toastr::warning('Account pending, wait for approval from Admin.');
                        auth()->guard('staff')->logout();
                        return redirect()->route('staff.login');
                        break;

                }
            }
        } else {
            Toastr::error('Login to access your dashboard');
            return redirect()->route('staff.login');
        }
    }
}
