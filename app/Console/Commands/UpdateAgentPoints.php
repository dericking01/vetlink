<?php

// app/Console/Commands/UpdateAgentPoints.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Agent;
use App\Models\Orders;

class UpdateAgentPoints extends Command
{
    protected $signature = 'agents:update-points';

    protected $description = 'Update points for agents based on order total amount';

    public function handle()
    {
        // Query orders and calculate total amount for each agent
        $agentsTotalAmount = Orders::where('status', 'Completed')
            ->selectRaw('agent_id, sum(total_amount) as total_amount')
            ->groupBy('agent_id')
            ->get();

        // Update points for each agent based on the total amount
        foreach ($agentsTotalAmount as $agentTotal) {
            $points = $this->calculatePoints($agentTotal->total_amount);
            Agent::where('id', $agentTotal->agent_id)->update(['points' => $points]);
        }

        $this->info('Agent points updated successfully.');
    }

    private function calculatePoints($totalAmount)
    {
        // Determine points based on total amount ranges
        if ($totalAmount >= 1 && $totalAmount <= 10000) {
            return 10;
        } elseif ($totalAmount >= 11000 && $totalAmount <= 20000) {
            return 20;
        } elseif ($totalAmount >= 21000 && $totalAmount <= 30000) {
            return 30;
        } elseif ($totalAmount >= 31000 && $totalAmount <= 40000) {
            return 40;
        } elseif ($totalAmount >= 41000 && $totalAmount <= 50000) {
            return 50;
        } elseif ($totalAmount >= 51000 && $totalAmount <= 60000) {
            return 60;
        } elseif ($totalAmount >= 61000 && $totalAmount <= 90000) {
            return 60;
        } elseif ($totalAmount >= 100000 && $totalAmount <= 6000000) {
            return 100;
        }
        // Add more ranges as needed

        // Default value if total amount doesn't fall within any range
        return 0;
    }
}

