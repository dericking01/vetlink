<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SmsCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('SMS Callback Received:', $request->all());

        // Validate the incoming data (optional but recommended)
        $validated = $request->validate([
            'message_id' => 'required|string',
            'PhoneNumber' => 'required|string',
            'DLRStatus' => 'required|string', // Delivery status
            'Remarks' => 'nullable|string',
            // Add other fields as needed
        ]);


        // Respond to Sprint SMS to acknowledge receipt
        return response()->json(['status' => 'success']);
    }
}
