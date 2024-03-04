<?php

namespace App\Http\Controllers\seller\business;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Models\seller\SellerBankInfo;
use App\Models\WithdrawHistory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MyWalletController extends Controller
{
    public function index(){
        $authenticatedSellerId = auth('seller')->user()->id;

        $bankInfos = SellerBankInfo::where('seller_id', auth('seller')->user()->id)
                    ->where('status', 'Billable')
                    ->latest()
                    ->get();

        $withdraws = WithdrawHistory::where('seller_id', $authenticatedSellerId)->latest()->get();

        $orderItems = OrderItems::whereHas('order', function ($query) use ($authenticatedSellerId) {
                $query->where('status', 'Completed')
                    ->where('seller_id', $authenticatedSellerId);
            })
            ->where('seller_id', $authenticatedSellerId)
            ->get();

            $totalWithdraw = WithdrawHistory::where('seller_id', $authenticatedSellerId)
            ->where(function ($query) {
                $query->where('status', 'Pending')
                      ->orWhere('status', 'Completed');
            })
            ->sum('amount'); 
            
        $pendingWithdraw = WithdrawHistory::where('seller_id', $authenticatedSellerId)->where('status', 'Pending')->sum('amount');
        $successWithdraw = WithdrawHistory::where('seller_id', $authenticatedSellerId)->where('status', 'Completed')->sum('amount');

        $totalBalance = $orderItems->sum('amount');
        $totalCommission = $orderItems->sum('sab_commission');
        $withdrawableBalance = $totalBalance - ($totalCommission + $totalWithdraw);

        return view('seller.business.my-wallet', compact('totalBalance', 'totalCommission', 'withdrawableBalance', 'bankInfos', 'pendingWithdraw', 'successWithdraw', 'withdraws'));
    }

    public function withdraw(Request $request){

        // dd($request->amount);

        $authenticatedSellerId = auth('seller')->user()->id;

        $orderItems = OrderItems::whereHas('order', function ($query) use ($authenticatedSellerId) {
                $query->where('status', 'Completed')
                    ->where('seller_id', $authenticatedSellerId);
            })
            ->where('seller_id', $authenticatedSellerId)
            ->get();

        $totalWithdraw = WithdrawHistory::where('seller_id', $authenticatedSellerId)
            ->where(function ($query) {
                $query->where('status', 'Pending')
                        ->orWhere('status', 'Completed');
            })
            ->sum('amount'); 

        $totalBalance = $orderItems->sum('amount');
        $totalCommission = $orderItems->sum('sab_commission');
        $withdrawableBalance = $totalBalance - ($totalCommission + $totalWithdraw);


        if( $request->amount > $withdrawableBalance | $withdrawableBalance == 0){
            Toastr::error("You don't have enough balance to make this withdraw!");
            return back();
        }

        WithdrawHistory::create([
            'seller_id' => auth('seller')->user()->id,
            'seller_bank_info_id' => $request->payment,
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);
        

        Toastr::success('Withdraw request successfully added!');
        return back();
    }
}
