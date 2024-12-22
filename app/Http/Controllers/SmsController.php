<?php

namespace App\Http\Controllers;

use App\Services\SprintSmsService;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    protected $smsService;

    public function __construct(SprintSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSingleSms()
    {
        $phoneNumber = '255786587784';
        $message = 'Hello, this is a SINGLE test SMS';

        $this->smsService->sendSms($phoneNumber,$message);
        // return response()->json($response);
        // try {
        //     Log::info("Controller: Sending single SMS", [
        //         'phoneNumber' => $phoneNumber,
        //         'message' => $message,
        //     ]);

        //     $response = $this->smsService->sendSms($phoneNumber, $message);

        //     Log::info("Controller: Single SMS sent successfully", [
        //         'response' => $response,
        //     ]);

        //     return response()->json([
        //         'status' => 'success',
        //         'response' => $response,
        //     ], 200);
        // } catch (\Exception $e) {
        //     Log::error("Controller: Error sending single SMS", [
        //         'error' => $e->getMessage(),
        //         'phoneNumber' => $phoneNumber,
        //         'message' => $message,
        //     ]);

        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Failed to send SMS',
        //     ], 500);
        // }
    }

    public function sendBulkSms()
    {
        $phoneNumbers = ['255712345678', '255713456789'];
        $message = 'Hello, this is a bulk SMS';

        try {
            Log::info("Controller: Sending bulk SMS", [
                'phoneNumbers' => $phoneNumbers,
                'message' => $message,
            ]);

            $response = $this->smsService->sendBulkSms($phoneNumbers, $message);

            Log::info("Controller: Bulk SMS sent successfully", [
                'response' => $response,
            ]);

            return response()->json([
                'status' => 'success',
                'response' => $response,
            ], 200);
        } catch (\Exception $e) {
            Log::error("Controller: Error sending bulk SMS", [
                'error' => $e->getMessage(),
                'phoneNumbers' => $phoneNumbers,
                'message' => $message,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send bulk SMS',
            ], 500);
        }
    }
}
