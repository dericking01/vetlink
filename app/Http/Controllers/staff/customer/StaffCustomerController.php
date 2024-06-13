<?php

namespace App\Http\Controllers\staff\customer;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Orders;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StaffCustomerController extends Controller
{
    //
    public function agents()
    {
        $agents = Agent::latest()->get();
        // dd($agents);
        return view('staff.customers.listagents', compact('agents'));
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
        $agentId = 'DOD-' . date('Y') . '-' . mt_rand(1000, 9999);

        // Ensure the generated agent ID is unique
        while (Agent::where('agent_id', $agentId)->exists()) {
            $agentId = 'DOD-' . date('Y') . '-' . mt_rand(1000, 9999);
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

    public function viewAgent($id)
    {
        $agent = Agent::whereId($id)->first();

        $orders = Orders::where('agent_id', $id)->where('status', 'Completed')->with('orderItems')->get();

        // dd($orders);
        return view('staff.customers.view-agent', compact('agent', 'orders'));
    }

    public function viewAgentCard($id)
    {
        $agent = Agent::whereId($id)->first();

        $orders = Orders::where('agent_id', $id)->where('status', 'Completed')->with('orderItems')->get();

        // dd($orders);
        return view('staff.customers.view-agent-card', compact('agent', 'orders'));
        // return view('admin.users.vd', compact('agent', 'orders'));
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
}
