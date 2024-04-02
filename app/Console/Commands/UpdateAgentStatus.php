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
        $agents = Agent::where('updated_at', '<', Carbon::now()->subDays(30))
        ->where('status', 'Active')
        ->get();

        foreach ($agents as $agent) {
        $agent->status = 'Inactive';
        $agent->save();
        }

        $this->info('Agent statuses updated successfully.');
    }
}
