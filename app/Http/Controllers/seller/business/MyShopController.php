<?php

namespace App\Http\Controllers\seller\business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyShopController extends Controller
{
    public function index(){
        return view('seller.business.my-shop');
    }
}
