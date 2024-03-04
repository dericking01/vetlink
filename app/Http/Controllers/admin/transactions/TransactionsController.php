<?php

namespace App\Http\Controllers\admin\transactions;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\WithdrawHistory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {

        $withdraws = WithdrawHistory::with('seller')->where('status', 'Pending')->latest()->get();
        $histories = WithdrawHistory::latest()->get();
        // dd($histories);
        // $histories = WithdrawHistory::pluck('status')->unique();

        return view('admin.transactions.withdrwlReq',compact('withdraws','histories'));
    }

    public function settledTrans()
    {
        $withdraws = WithdrawHistory::where('status', 'Completed')->orwhere('status', 'Failed')->latest()->get();
        // dd($withdraws);
        return view('admin.transactions.settledTrans',compact('withdraws'));
    }

    public function approve(Request $request)
    {

        $withdraw = WithdrawHistory::find($request->id);

        if (!$withdraw) {
            Toastr::error('Withdrawal record not found');
            return back();
        }

        $withdraw->status = 'Completed';

        // dd($withdraw);
        $withdraw->save();
        Toastr::success('Request successfully approved!');
        return back();
    }

    public function reject(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $withdraw = WithdrawHistory::find($request->id);

        if (!$withdraw) {
            Toastr::error('Withdrawal record not found');
            return back();
        }

        $withdraw->status = 'Failed';
        $withdraw->reason = $request->description;

        // dd($withdraw);
        $withdraw->save();
        Toastr::success('Request successfully rejected!');
        return back();
    }
}
