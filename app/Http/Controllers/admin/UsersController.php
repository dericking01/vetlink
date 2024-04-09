<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\MarketProduct;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.listusers', compact('users'));
    }

    public function sellers()
    {
        $sellers = Seller::get();
        // dd($sellers);
        return view('admin.users.listsellers', compact('sellers'));
    }

    public function agents()
    {
        $agents = Agent::latest()->get();
        // dd($agents);
        return view('admin.users.listagents', compact('agents'));
    }

    public function branches()
    {
        $branches = Branch::latest()->get();
        // dd($branches);

        return view('admin.users.listbranches', compact('branches'));
    }

    public function storeBranch(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'location' => 'nullable|string',
        ]);

        // dd($request->all());

        Branch::create([
            'branch_name' => $request->name,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        Toastr::success('Branch successfully added ✔');
        return back();
    }

    public function updateBranch(Request $request, $id)
    {
        $branches = Branch::findOrFail($id);

        $validationRules = [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'location' => 'required|regex:/^[a-zA-Z\s]+$/',
        ];

        $this->validate($request, $validationRules);

        $branches->branch_name = $request->name;
        $branches->location = $request->location;
        $branches->status = $request->status;
        // dd($request);
        $branches->save();

        Toastr::success('Branch successfully updated!');
        return back();
    }

    public function destroyBranch(Request $request)
    {
        $branch = Branch::find($request->id);

        // Check if the branch has any associated orders
        if ($branch->order()->exists()) {
            Toastr::error('Branch has associated orders. It cannot be deleted!');
            return back();
        }

        if($branch->status == 'active'){
            Toastr::error('You cannot delete an active branch');
            return back();
        }
        // dd($branches);

        $branch->delete();
        Toastr::success('Branch successfully deleted!');
        return back();
    }


    public function storeAgent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'gender' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $promo = Str::substr(Str::upper($request->name), 0, 1) . mt_rand(10000, 99999);

        // Generate a unique agent ID
        $agentId = 'VET-' . date('Y') . '-' . mt_rand(1000, 9999);

        // Ensure the generated agent ID is unique
        while (Agent::where('agent_id', $agentId)->exists()) {
            $agentId = 'VET-' . date('Y') . '-' . mt_rand(1000, 9999);
        }

        // dd($request);
        // Create the agent with the unique agent ID
        Agent::create([
            'agent_id' => $agentId,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'location' => $request->location,
            'status' => $request->status,
            'promo_code' => $promo,
            'points' => 0,
            'password' => Hash::make('12345678'),
        ]);

        Toastr::success('Customer successfully added ✔');
        return back();
    }

    public function updateAgent(Request $request, $id)
    {

        $agents = Agent::findOrFail($id);

        // Check if email or phone number has changed
        // $emailChanged = $request->email !== $admin->email;
        $phoneChanged = $request->phone !== $agents->phone;

        // Define validation rules dynamically
        $validationRules = [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|regex:/^255\d{9}$/|digits:12',
        ];

        if ($phoneChanged) {
            $validationRules['phone'] .= '|unique:agents,phone';
        }

        $this->validate($request, $validationRules);
        // dd($request);
        // dd($request->all());

        $agents->name = $request->name;
        $agents->phone = $request->phone;
        $agents->location = $request->location;
        $agents->email = $request->email;
        $agents->status = $request->status;
        // dd($agents);
        $agents->save();

        Toastr::success('Customer successfully updated!');
        return back();
    }

    public function destroy(Request $request)
    {

        $agents = Agent::find($request->id);

        if($agents->status == 'Active'){
            Toastr::error('You cannot delete active Customer');
            return back();
        }

        $agents->delete();
        Toastr::success('Customer successfully deleted!');
        return back();
    }

    public function updateSeller(Request $request, $id)
    {

        $sellers = Seller::findOrFail($id);


        $sellers->status = $request->status;
        // dd($request->all());
        $sellers->save();

        Toastr::success('Seller successfully updated!');
        return back();
    }

    public function destroySeller(Request $request)
    {

        $sellers = Seller::find($request->id);

        if($request->id == 1){
            Toastr::error('You cannot delete admin seller');
            return back();
        }

        if($sellers->status == 'Approved'){
            Toastr::error('You cannot delete active Seller');
            return back();
        }

        $sellers->delete();
        Toastr::success('Sellers successfully deleted!');
        return back();
    }

    public function destroyBuyer(Request $request)
    {

        $Buyers = User::find($request->id);
        // dd($request->id);
        $Buyers->delete();
        Toastr::success('Buyer successfully deleted!');
        return back();
    }

    public function viewAgent($id)
    {
        $agent = Agent::whereId($id)->first();

        $orders = Orders::where('agent_id', $id)->where('status', 'Completed')->with('orderItems')->get();

        // dd($orders);
        return view('admin.users.view-agent', compact('agent', 'orders'));
    }

    public function viewAgentCard($id)
    {
        $agent = Agent::whereId($id)->first();

        $orders = Orders::where('agent_id', $id)->where('status', 'Completed')->with('orderItems')->get();

        // dd($orders);
        return view('admin.users.view-agent-card', compact('agent', 'orders'));
        // return view('admin.users.vd', compact('agent', 'orders'));
    }

    // public function viewSeller($id)
    public function viewSeller($id)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            redirect();
        }

        // Initialize totalProductPrice
        $totalProductPrice = 0;

        if ($id == 1) {
            $products = $seller->products()->get();
        } else {
            $products = $seller->marketProducts()->get();
        }

        // Calculate the total product price
        foreach ($products as $product) {
            $totalProductPrice += $product->price * $product->quantity;
        }

        return view('admin.users.view-seller', compact('products', 'seller', 'totalProductPrice'));
    }


    public function viewUser($id)
    {
        $user = User::whereId($id)->first();
        $orders = Orders::where('user_id', $id)
                  //  ->where('status', 'Completed')
                    ->with('orderItems')
                    ->get();

        // dd($orders);
        return view('admin.users.view-user', compact('user', 'orders'));
    }

}
