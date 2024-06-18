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

    // public function submit(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required',
    //         'password' => 'required|min:8'
    //     ]);

    //     $remember = ($request['remember']) ? true : false;

    //     if (auth('staff')->attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {
    //        // Update the last login timestamp using DB::update()
    //         DB::table('staffs')
    //         ->where('id', auth('staff')->user()->id)
    //         ->update(['last_login_at' => Carbon::now()]);

    //         $greeting = SettingsHelper::getGreeting();
    //         $staff = auth('staff')->user()->name;
    //         Toastr::info($greeting. ' ' .$staff. '!' .' Welcome back!');
    //         return redirect()->route('staff.createorder');
    //     }

    //     return redirect()->back()->withInput($request->only('phone', 'remember', 'password'))
    //         ->withErrors(['Credentials does not match.']);
    // }

    public function submit(Request $request)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:8'
        ]);

        // Check if 'remember' checkbox is checked
        $remember = $request->has('remember');

        // Attempt to log in the staff
        if (auth('staff')->attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {

            // Update the last login timestamp
            DB::table('staffs')
                ->where('id', auth('staff')->user()->id)
                ->update(['last_login_at' => Carbon::now()]);

            // Get the role of the authenticated staff
            $staff = auth('staff')->user();
            $role = $staff->role; // Assuming 'role' is the column name

            // Display a welcome message
            $greeting = SettingsHelper::getGreeting();
            Toastr::info($greeting . ' ' . $staff->name . '! Welcome back!');

            // Redirect based on role
            if ($role === 'delivery') {
                return redirect()->route('staff.deliveries');
            } elseif ($role === 'staff') {
                return redirect()->route('staff.createorder');
            } else {
                // Handle other roles or invalid roles if necessary
                return redirect()->route('staff.dashboard');
            }
        }

        // Redirect back with an error message if authentication fails
        return redirect()->back()
            ->withInput($request->only('phone', 'remember', 'password'))
            ->withErrors(['Credentials do not match.']);
    }


    public function logout(Request $request)
    {
        auth()->guard('staff')->logout();

        $request->session()->invalidate();
        Toastr::info('Thank you, welcome again!');
        return redirect()->route('staff.login');
    }
}
