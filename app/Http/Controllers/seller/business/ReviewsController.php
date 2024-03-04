<?php

namespace App\Http\Controllers\seller\business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(){
        return view('seller.business.reviews');
    }
}
