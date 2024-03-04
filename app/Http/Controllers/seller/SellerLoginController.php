<?php

namespace App\Http\Controllers\seller;

use App\Helpers\SettingsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SellerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('seller.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:8'
        ]);

        $remember = ($request['remember']) ? true : false;

        if (auth('seller')->attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {
            $greeting = SettingsHelper::getGreeting();
            $seller = auth('seller')->user()->name;
            Toastr::info($greeting. ' ' .$seller. '!' .' Welcome back!');
            return redirect()->route('seller.dashboard');
        }

        return redirect()->back()->withInput($request->only('phone', 'remember', 'password'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('seller')->logout();

        $request->session()->invalidate();
        Toastr::info('Thank you, welcome again!');
        return redirect()->route('seller.login');
    }
}
