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

        // Extracting relevant data for readability
        $messageId = $request->get('message_id');
        $phoneNumber = $request->get('PhoneNumber');
        $smsMessage = $request->get('SMSMessage');
        $messageType = $request->get('MessageType');
        $messageLength = $request->get('MessageLength');
        $clientCost = $request->get('ClientCost');
        $dlrStatus = $request->get('DLRStatus');
        $errorCode = $request->get('ErrorCode');
        $errorDescription = $request->get('ErrorDescription');
        $sentDateUTC = $request->get('SentDateUTC');
        $remarks = $request->get('Remarks');
        $senderId = $request->get('SenderId');

        // Log the request in a more readable format
        Log::warning('SMS Callback Received:', [
            'Message ID' => $messageId,
            'Phone Number' => $phoneNumber,
            'SMS Message' => $smsMessage,
            'Message Type' => $messageType,
            'Message Length' => $messageLength,
            'Client Cost' => $clientCost,
            'DLR Status' => $dlrStatus,
            'Error Code' => $errorCode,
            'Error Description' => $errorDescription,
            'Sent Date' => $sentDateUTC,
            'Remarks' => $remarks,
            'Sender ID' => $senderId,
        ]);

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
