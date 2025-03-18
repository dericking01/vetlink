<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Models\ProductStock;
use App\Services\SprintSmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendOrderCompletionSms implements ShouldQueue
{
    use InteractsWithQueue;

    protected $smsService;

    public function __construct(SprintSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function handle(OrderCompleted $event)
    {
        $order = $event->order;
        $customerPhoneNumber = $order->agent->phone; // Customer's phone #
        // Extract the first name only (split by space and take the first part)
        $firstName = explode(' ', trim($order->agent->name))[0];
        // Format the total amount properly
        $formattedAmount = number_format($order->total_amount, 0, '.', ',');
        // Get the product names from the order items
        $products = $order->orderItems->map(function ($item) {
            // Check if the productable type is ProductStock to access related AdminProduct details
            if ($item->productable instanceof ProductStock) {
                return $item->productable->adminProduct->name ?? 'N/A';
            }

            // For any other productable type, handle differently if needed
            return $item->productable->adminProduct->name ?? 'N/L';
        });

        // Convert product names into a comma-separated string
        $productNames = $products->implode(', ');

        // Construct the SMS message
        $fullMessage = "
        Habari {$firstName}, asante kwa kuwa mteja wetu! Malipo yako ya {$formattedAmount}
        kwa bidhaa {$productNames} yamepokelewa. Karibu tena Dodoki Ltd, tunashukuru kwa kuamini huduma zetu!
        ";

        // Normalize message (remove new lines and extra spaces)
        $fullMessage = trim(preg_replace('/\s+/', ' ', $fullMessage));

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
