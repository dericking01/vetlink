<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('password.forgetpassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in admins or staffs table
        $adminUser = DB::table('admins')->where('email', $request->email)->first();
        $staffUser = DB::table('staffs')->where('email', $request->email)->first();

        if (!$adminUser && !$staffUser) {
            Toastr::error('The email does not exist in our records!!');
            return back();
        }

        // Check if a reset token already exists for this email
        $existingToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($existingToken) {
            // Token already exists, show the toast message and return
            Toastr::info('We already sent you a password reset link.');
            return redirect()->route('admin.login');
        }

        // Generate a new token
        $token = Str::random(64);

        // Insert the token into the password_reset_tokens table
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Send the password reset email
        Mail::send("password.email-pwd", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        // Show success message and redirect
        Toastr::success('We have sent you an email to reset your password!');
        return redirect()->route('admin.login');
    }

    public function resetPassword($token)
    {
        return view('password.resetpassword', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'password' => "required|string|min:8|confirmed",
            'password_confirmation' => "required",
        ]);

        // Check if the email and token exist in the password_reset_tokens table
        $updatePassword = DB::table('password_reset_tokens')
        -> where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if (!$updatePassword) {
            Toastr::error('Invalid Request!');
            return redirect()->route('reset.password');
        }

        // Check if the email exists in the admins table
        $adminUser = DB::table('admins')->where('email', $request->email)->first();
        // Check if the email exists in the staffs table
        $staffUser = DB::table('staffs')->where('email', $request->email)->first();

        // Update password in the respective table
        if ($adminUser) {
        DB::table('admins')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        } elseif ($staffUser) {
            DB::table('staffs')
                ->where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
        } else {
            Toastr::error('User not found!');
            return redirect()->route('reset.password');
        }

        // Delete the password reset token
        DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();

        Toastr::success('Password Reset Successfully, Kindly Login!');
        return redirect()->route('admin.login');
    }
}
