<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SettingsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $remember = ($request['remember']) ? true : false;

        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $greeting = SettingsHelper::getGreeting();
            $admin = auth('admin')->user()->name;
            Toastr::info($greeting. ' ' .$admin. '!' .' Welcome back!');
            // return redirect()->route('admin.dashboard.home');
            return redirect()->route('admin.liststaffs');
        }

        return redirect()->back()->withInput($request->only('email', 'remember', 'password'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();
        Toastr::info('Thank you, welcome again!');
        return redirect()->route('admin.login');
    }
}
