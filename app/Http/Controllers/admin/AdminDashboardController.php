<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\OrderItems;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function home()
    {
        $totalActiveAgents = Agent::where('status', 'Active')->count();
        $totalInactiveAgents = Agent::where('status', 'Inactive')->count();
        $totalAgents = Agent::where('deleted_at', null)->count();
        $totalOrders = Orders::where('deleted_at', null)->count();
        $totalItems = OrderItems::where('deleted_at', null)->count();
        $PendingOrders = Orders::where('status', 'Pending')->count();
        $CompletedOrders = Orders::where('status', 'Completed')->count();
        $RejectedOrders = Orders::where('status', 'Cancelled')->count();

        // Retrieve the sum of total_amount where status is 'Completed'
        $totalCompletedAmount = Orders::where('status', 'Completed')
                                        ->whereDate('created_at',Carbon::today())
                                        ->sum('total_amount');

        $totalSale = Orders::where('status', 'Completed')->sum('total_amount');

        return view('admin.dashboard.home',
            compact(
                'totalCompletedAmount','totalActiveAgents','totalInactiveAgents','totalAgents','totalOrders','totalItems','totalSale','PendingOrders','CompletedOrders','RejectedOrders'
            )
        );
    }


}
