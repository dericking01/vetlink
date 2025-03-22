<?php

namespace App\Console\Commands;

use App\Models\Orders;
use App\Services\SprintSmsService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AlertCreditPurchases extends Command
{
    protected $signature = 'alert:credit-purchases';
    protected $description = 'Send SMS reminders for unpaid credit purchases';
    protected $smsService;

    public function __construct(SprintSmsService $smsService)
    {
        parent::__construct();
        $this->smsService = $smsService;
    }

    public function handle()
    {
        $orders = Orders::whereNotNull('partial_amt')
            ->whereColumn('total_amount', '!=', 'partial_amt')
            ->where('status', '!=', 'Completed') // Optional: Ensures the order is not fully paid
            ->whereDate('created_at', '<=', Carbon::now()->subDays(7)) // Sends reminders for older orders
            ->get();
        Log::info($orders);
        return true;
        if ($orders->isEmpty()) {
            $this->info('No pending credit purchases found.');
            return;
        }

        foreach ($orders as $order) {
            $firstName = explode(' ', trim($order->agent->name))[0]; // Get first name
            $remainingAmount = number_format($order->total_amount - $order->partial_amt, 0, '.', ','); // Format balance

            $message = "Habari {$firstName}, Unakumbushwa kulipa deni lako la Sh {$remainingAmount} kwa bidhaa ulizonunua. Tafadhali lipa kwa wakati ili kuepuka usumbufu. Asante!";

            try {
                Log::info("Sending credit alert SMS", [
                    'agent' => $order->agent->name,
                    'phone' => $order->agent->phone,
                    'message' => $message
                ]);

                // Send SMS
                $this->smsService->sendBulkSms([$order->agent->phone], $message);

                Log::info("SMS sent successfully to {$order->agent->phone}");
            } catch (\Exception $e) {
                Log::error("Error sending SMS: " . $e->getMessage());
            }
        }

        $this->info('Credit purchase reminders sent successfully.');
    }
}
