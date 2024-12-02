<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SprintSmsService
{
    protected $apiUrl;
    protected $apiId;
    protected $apiPassword;
    protected $senderId;

    public function __construct()
    {
        $this->apiUrl = config('services.sprint_sms.url');
        $this->apiId = config('services.sprint_sms.api_id');
        $this->apiPassword = config('services.sprint_sms.api_password');
        $this->senderId = config('services.sprint_sms.sender_id');
    }

    public function sendSms($phoneNumber, $message, $smsType = 'P', $encoding = 'T')
    {
        $code = Agent::getCode();

        try {
            Log::info("Attempting to send SMS", [
                'phoneNumber' => $phoneNumber,
                'message' => $message,
                'smsType' => $smsType,
                'encoding' => $encoding,
            ]);

            $response = Http::get("{$this->apiUrl}/SendSMS", [
                'api_id' => $this->apiId,
                'api_password' => $this->apiPassword,
                'sms_type' => $smsType,
                'encoding' => $encoding,
                'sender_id' => $this->senderId,
                'phonenumber' => $phoneNumber,
                'textmessage' => $message,
                'uid' => $code,
                'callback_url' => env('SMS_CALLBACK_URL'),
            ]);

            Log::info("SMS sent successfully", [
                'response' => $response->json(),
            ]);
            
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Error sending SMS", [
                'error' => $e->getMessage(),
                'phoneNumber' => $phoneNumber,
                'message' => $message,
            ]);

            throw $e; // Re-throw the exception to handle it further up the stack
        }
    }

    public function sendBulkSms(array $phoneNumbers, $message, $smsType = 'T', $encoding = 'T')
    {
        try {
            Log::info("Attempting to send bulk SMS", [
                'phoneNumbers' => implode(',', $phoneNumbers),
                'message' => $message,
                'smsType' => $smsType,
                'encoding' => $encoding,
            ]);

            $response = Http::post("{$this->apiUrl}/SendSMSMulti", [
                'api_id' => $this->apiId,
                'api_password' => $this->apiPassword,
                'sms_type' => $smsType,
                'encoding' => $encoding,
                'sender_id' => $this->senderId,
                'phonenumber' => implode(',', $phoneNumbers),
                'textmessage' => $message,
            ]);

            Log::info("Bulk SMS sent successfully", [
                'response' => $response->json(),
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error("Error sending bulk SMS", [
                'error' => $e->getMessage(),
                'phoneNumbers' => $phoneNumbers,
                'message' => $message,
            ]);

            throw $e;
        }
    }
}
