<?php

namespace App\Http\Controllers\staff;

use App\Helpers\SettingsHelper;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StaffLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:staff', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('staff.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:8'
        ]);

        $remember = ($request['remember']) ? true : false;

        if (auth('staff')->attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {
           // Update the last login timestamp using DB::update()
            DB::table('staffs')
            ->where('id', auth('staff')->user()->id)
            ->update(['last_login_at' => Carbon::now()]);

            $greeting = SettingsHelper::getGreeting();
            $staff = auth('staff')->user()->name;
            Toastr::info($greeting. ' ' .$staff. '!' .' Welcome back!');
            return redirect()->route('staff.createorder');
        }

        return redirect()->back()->withInput($request->only('phone', 'remember', 'password'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('staff')->logout();

        $request->session()->invalidate();
        Toastr::info('Thank you, welcome again!');
        return redirect()->route('staff.login');
    }
}
