<?php

// app/Observers/OrderObserver.php

namespace App\Observers;

use App\Models\Agent;
use App\Models\Orders;

class OrderObserver
{
    public function created(Orders $order)
    {
        $this->updateAgentPoints($order->agent_id);
    }

    public function updated(Orders $order)
    {
        // Check if the status has been changed to 'Completed'
        if ($order->isDirty('status') && $order->status === 'Completed') {
            $this->updateAgentPoints($order->agent_id);
        }
    }

    protected function updateAgentPoints($agentId)
    {
        // Calculate total amount of orders for the agent
        $totalAmount = Orders::where('agent_id', $agentId)->where('status', 'Completed')->sum('total_amount');

        // Calculate points based on total amount ranges
        $points = 0;
        if ($totalAmount >= 1 && $totalAmount <= 10000) {
            $points = 10;
        } elseif ($totalAmount >= 11000 && $totalAmount <= 20000) {
            $points = 20;
        } elseif ($totalAmount >= 21000 && $totalAmount <= 30000) {
            $points = 30;
        } elseif ($totalAmount >= 31000 && $totalAmount <= 40000) {
            $points = 40;
        } elseif ($totalAmount >= 41000 && $totalAmount <= 50000) {
            $points = 50;
        } elseif ($totalAmount >= 51000 && $totalAmount <= 60000) {
            $points = 60;
        }
        // Add more conditions for additional ranges if needed

        // Update agent's points in the agents table
        Agent::where('id', $agentId)->update(['points' => $points]);
    }
}
