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

            // Get the role of the authenticated staff
            $staff = auth('staff')->user();
            $role = $staff->role; // Assuming 'role' is the column name

            // Check the status immediately after login
            if ($staff->status === 'inactive') {
                // Log the user out if inactive
                auth('staff')->logout();
                Toastr::warning('Account pending, wait for approval from Admin.');
                return redirect()->route('staff.login');
            }

            // Update the last login timestamp
            DB::table('staffs')
                ->where('id', auth('staff')->user()->id)
                ->update(['last_login_at' => Carbon::now(), 'is_online' => true]);

            // Display a welcome message
            $greeting = SettingsHelper::getGreeting();
            Toastr::info($greeting . ' ' . $staff->name . '! Welcome back!');

            // Redirect based on role
            if ($role === 'delivery') {
                return redirect()->route('staff.deliveries');
            } elseif ($role === 'staff') {
                return redirect()->route('staff.createorder');
            } elseif ($role === 'orderman') {
                return redirect()->route('orderman.orders');
            } elseif ($role === 'auditor') {
                return redirect()->route('audit.warehouse.products');
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
        // Retrieve the currently authenticated staff user
        $staff = auth()->guard('staff')->user();

        // Update the is_online status to false using DB::table()->update()
        if ($staff) {
            DB::table('staffs')
                ->where('id', $staff->id)
                ->update(['is_online' => false]);
        }

        // Log out the staff and invalidate the session
        auth()->guard('staff')->logout();

        $request->session()->invalidate();

        Toastr::info('Thank you, welcome again!');
        return redirect()->route('staff.login');
    }

}
