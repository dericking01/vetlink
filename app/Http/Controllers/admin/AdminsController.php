<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::where('id', '!=', 1)->latest()->get();
        return view('admin.users.admins', compact('admins'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => [
                'required',
                'numeric',
                'regex:/^0\d{9}$/',
                'digits:10',
                Rule::unique('admins', 'phone')->where(function ($query) use ($request) {
                    return $query->where('phone', $request->phone);
                }),
            ],
            'email' => 'required|email|unique:admins,email',
            // 'role' => 'required|in:admin'
        ], [
            'phone.unique' => 'Phone number is already in use.',
        ]);

        // Extract the last 9 digits of the phone number
        $lastNineDigits = substr($request->phone, -9);

        // Prepend '255' to the extracted digits
        $phoneNumber = '255' . $lastNineDigits;

        // Check if the phone number already exists
        if (Admin::where('phone', $phoneNumber)->exists()) {
            // Phone number already exists, toast a message and redirect back
            Toastr::error('Phone number is already in use.');
            return redirect()->back()->withInput($request->except('password'));
        }

        // Create a new Admin instance
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->phone = $phoneNumber;
        $admin->email = $request->email;
        $admin->role = 'admin';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('12345678');
        $admin->remember_token = Str::random(10);
        $admin->save();

        Toastr::success('Admin successfully added!');
        return redirect()->route('admin.listadmins');
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
            'phone' => [
                'required',
                'numeric',
                'regex:/^0\d{9}$/',
                'digits:10',
            ],
            'email' => 'required|email',
            // 'role' => 'required|in:admin'
        ];

        if ($emailChanged) {
            $validationRules['email'] .= '|unique:admins,email';
        }

        if ($phoneChanged) {
            $validationRules['phone'][] = Rule::unique('admins', 'phone')->where(function ($query) use ($request) {
                return $query->where('phone', $request->phone);
            });
        }

        $this->validate($request, $validationRules);

        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->role = 'admin';
        $admin->save();

        Toastr::success('Admin successfully updated!');
        return redirect()->route('admin.listadmins');
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
        Toastr::success('Admin successfully deleted!');
        return back();
    }


}
