<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     public function handle(Request $request, Closure $next)
     {
         if (Auth::guard('seller')->check()) {
             if (auth('seller')->user()->status == 'Approved') {
                 return $next($request);
             } else {
                 switch (auth('seller')->user()->status) {
                     case 'Pending':
                         Toastr::warning('Account pending, wait for approval from Admin.');
                         auth()->guard('seller')->logout();
                         return redirect()->route('seller.login');
                         break;
     
                     case 'Rejected':
                         Toastr::error('Account rejected, please contact your Admin.');
                         auth()->guard('seller')->logout();
                         return redirect()->route('seller.login');
                         break;
                 }
             }
         } else {
             Toastr::error('Login to access your dashboard');
             return redirect()->route('seller.login');
         }
     }
     
    
}
