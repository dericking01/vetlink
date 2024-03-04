<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.home');
    }

    public function about()
    {
        return view('website.about');
    }

    public function services()
    {
        return view('website.services');
    }

    public function team()
    {
        return view('website.team');
    }

    public function blog()
    {
        return view('website.blog');
    }

    public function contact()
    {
        return view('website.contact');
    }
}
