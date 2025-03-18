<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Services\SprintSmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendPointsGainedSms implements ShouldQueue
{
    use InteractsWithQueue;

    protected $smsService;

    public function __construct(SprintSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function handle(OrderCompleted $event)
    {
        sleep(10);
        $order = $event->order;
        $customerPhoneNumber = $order->agent->phone; // Customer's phone #
        // Extract the first name only (split by space and take the first part)
        $firstName = explode(' ', trim($order->agent->name))[0];

        $Pointsmessage = "
        Habari {$firstName}, Umejipatia pointi {$order->agent->points}
        Karibu tena Dodoki Ltd, Uendelee kufurahia huduma zetu!
        ";

        $Pointsmessage = trim(preg_replace('/\s+/', ' ', $Pointsmessage));
        Log::info("***********************HERE**************************");
        try {
            Log::info("Sending SMS for completed order", [
                'order_id' => $order->id,
                'phone_number' => $customerPhoneNumber,
                'message' => $Pointsmessage,
            ]);

            $response = $this->smsService->sendSms($customerPhoneNumber, $Pointsmessage);

            Log::info("SMS sent successfully", [
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            Log::error("Error sending order completion SMS", [
                'error' => $e->getMessage(),
                'order_id' => $order->id,
            ]);
        }

    }
}
