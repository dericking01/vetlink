<?php

namespace App\Http\Controllers\seller\business;

use App\Http\Controllers\Controller;
use App\Models\seller\SellerBankInfo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BankInfoController extends Controller
{
    public function index(){
        $bankInfos = SellerBankInfo::where('seller_id', auth('seller')->user()->id)->latest()->get();
        // dd($bankInfos->count());
        return view('seller.business.bank-info', compact('bankInfos'));
    }

    public function store(Request $request){

        $bankInfos = SellerBankInfo::where('seller_id', auth('seller')->user()->id)->latest()->get();

        if($bankInfos->count() >=6){
            Toastr::error('Bank information limit reached!');
            return back();
        }
        
        $this->validate($request, [
            'expires' => 'required|regex:/^\d{2}\/\d{2}$/',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'number' => 'required|numeric|unique:seller_bank_infos,number',
        ], [
            'expires.regex' => 'Please use correct format or use 00/00',
            'name.regex' => 'Name entered is invalid!',
            'number.unique' => 'Entered number already taken!'
        ]);
        // dd($request->all());

        $bankInfos = new SellerBankInfo();
        $bankInfos->seller_id = auth('seller')->user()->id;
        $bankInfos->name = $request->name;
        $bankInfos->number = $request->number;
        $bankInfos->type = $request->paymentType;
        $bankInfos->issuer = $request->issuer;
        $bankInfos->expires = $request->expires;
        $bankInfos->status = $request->status;

        $bankInfos->save();

        Toastr::success('Bank information successfully added!');
        return back();
    }
}
