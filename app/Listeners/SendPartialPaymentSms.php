<?php

namespace App\Listeners;

use App\Events\OrderPartiallyPaid;
use App\Models\ProductStock;
use App\Services\SprintSmsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class SendPartialPaymentSms
{
    protected $smsService;

    public function __construct(SprintSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function handle(OrderPartiallyPaid $event)
    {
        $order = $event->order;
        $amountPaid = $event->amountPaid;
        Log::info("PARTIAL AMT==>" .$amountPaid);
        $customerPhoneNumber = $order->agent->phone; // Customer's phone #

        $firstName = explode(' ', trim($order->agent->name))[0]; // Get first name
        $remainingBalance = number_format($order->total_amount - $order->partial_amt, 0, '.', ','); // Format balance
        $formattedAmountPaid = number_format($amountPaid, 0, '.', ',');
        Log::info("PARTIAL AMT two ==>" .$amountPaid);

        // Retrieve product names
        $products = $order->orderItems->map(function ($item) {
            // Check if the productable type is ProductStock to access related AdminProduct details
            if ($item->productable instanceof ProductStock) {
                return $item->productable->adminProduct->name ?? 'N/A';
            }

            // For any other productable type, handle differently if needed
            return $item->productable->adminProduct->name ?? 'N/L';
        });

        $productNames = $products->implode(', ');

        $message = "Habari {$firstName}, umelipa Sh {$formattedAmountPaid} kwa bidhaa: {$productNames}. Salio la deni ni Sh {$remainingBalance}. Tafadhali malizia malipo. Asante!";

        $fullMessage = trim(preg_replace('/\s+/', ' ', $message));

        // Split message if it exceeds 160 characters
        $smsParts = Str::of($fullMessage)->wordWrap(160, "\n")->explode("\n");

        // Send each SMS part separately
        foreach ($smsParts as $part) {
            try {
                Log::info("Sending SMS part: " . $part);
                $this->smsService->sendSms($customerPhoneNumber, $part);
            } catch (\Exception $e) {
                Log::error("Error sending SMS: " . $e->getMessage());
            }
        }

    }
}
