<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class VetStaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->get();
        dd('welcome bro');
        return view('admin.users.staffs', compact('staffs'));
    }
}
