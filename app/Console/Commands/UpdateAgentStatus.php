<?php

namespace App\Console\Commands;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateAgentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agents:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update agent status to Inactive if not updated for 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $agents = Agent::where('status', 'Active')->get();
    
        foreach ($agents as $agent) {
            // Get the latest 'Completed' order for the agent
            $latestOrder = $agent->order()
                ->where('status', 'Completed')
                ->latest('created_at')
                ->first();
    
            // Check if the latest completed order exists and is older than 90 days
            if ($latestOrder && Carbon::parse($latestOrder->created_at)->lt(Carbon::now()->subDays(90))) {
                $agent->status = 'Inactive';
                $agent->save();
            }
        }
    
        $this->info('Agent statuses updated successfully.');
    }
    
}
