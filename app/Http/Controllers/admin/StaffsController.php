<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffsController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.users.staffs', compact('admins'));
    }

    public function createStaffView()
    {
        return view('admin.users.create-staff');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12|unique:admins,phone',
            'email' => 'required|email|unique:admins,email',
            // 'role' => 'required|in:admin'
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->role = 'admin';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('12345678');
        $admin->remember_token = Str::random(10);
        $admin->save();

        Toastr::success('Staff successfully added!');
        return redirect()->route('admin.liststaffs');
    }

    public function editStaff($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.users.edit-staff', compact('admin'));
    }

    public function update(Request $request, $id)
    {



        $admin = Admin::findOrFail($id);

        // Check if email or phone number has changed
        $emailChanged = $request->email !== $admin->email;
        $phoneChanged = $request->phone !== $admin->phone;

        // Define validation rules dynamically
        $validationRules = [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12',
            'email' => 'required|email',
            // 'role' => 'required|in:admin'
        ];

        if ($emailChanged) {
            $validationRules['email'] .= '|unique:admins,email';
        }

        if ($phoneChanged) {
            $validationRules['phone'] .= '|unique:admins,phone';
        }

        $this->validate($request, $validationRules);


        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->role = 'admin';
        $admin->save();

        Toastr::success('Staff successfully updated!');
        return redirect()->route('admin.liststaffs');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        if(auth('admin')->user()->id == $request->id){
            Toastr::error('You cannot delete yourself 😒');
            return back();
        }

        $staff = Admin::find($request->id);
        $staff->delete();
        Toastr::success('Staff successfully deleted!');
        return back();
    }


}
