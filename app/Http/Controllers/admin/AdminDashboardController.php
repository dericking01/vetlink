<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function home()
    {
        return view('admin.dashboard.home');
    }

    public function analytics()
    {
        return view('admin.dashboard.analytics');
    }

    public function crm()
    {
        return view('admin.dashboard.crm');
    }

    public function shop()
    {
        return view('admin.dashboard.shop');
    }

    public function lms()
    {
        return view('admin.dashboard.lms');
    }

    public function management()
    {
        return view('admin.dashboard.management');
    }

    public function saas()
    {
        return view('admin.dashboard.saas');
    }

    public function support()
    {
        return view('admin.dashboard.support');
    }
}
