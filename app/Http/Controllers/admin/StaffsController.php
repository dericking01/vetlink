<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Staff;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffsController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->get();
        return view('admin.users.staffs', compact('staffs'));
    }


    public function store(Request $request)
    {
        $adminId = auth('admin')->user()->id;

        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12|unique:admins,phone',
            'email' => 'required|email|unique:admins,email',
            // 'role' => 'required|in:admin'
        ]);

        $staff = new Staff();
        $staff->admin_id = $adminId;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->role = 'staff';
        $staff->status = $request->status;
        $staff->location = $request->location;
        $staff->email_verified_at = now();
        $staff->password = Hash::make('staff2024');
        $staff->remember_token = Str::random(10);

        dd($staff);

        $staff->save();


        Toastr::success('Staff successfully added!');
        return redirect()->route('admin.liststaffs');
    }


    public function update(Request $request, $id)
    {



        $staff = Staff::findOrFail($id);

        // Check if email or phone number has changed
        $emailChanged = $request->email !== $staff->email;
        $phoneChanged = $request->phone !== $staff->phone;

        // Define validation rules dynamically
        $validationRules = [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12',
            'email' => 'required|email',
            // 'role' => 'required|in:staff'
        ];

        if ($emailChanged) {
            $validationRules['email'] .= '|unique:stafs,email';
        }

        if ($phoneChanged) {
            $validationRules['phone'] .= '|unique:stafs,phone';
        }

        $this->validate($request, $validationRules);


        $staff->name = $request->name;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->role = 'staff';
        $staff->status = $request->status;
        $staff->location = $request->location;

        dd($staff);

        $staff->save();

        Toastr::success('Staff successfully updated!');
        return redirect()->route('admin.liststaffs');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);

        $staff = Staff::find($request->id);
        $staff->delete();
        Toastr::success('Staff successfully deleted!');
        return back();
    }


}
