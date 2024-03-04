<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Agent;
use Carbon\Carbon;

class GenerateAgentIds extends Command
{
    protected $signature = 'agent:generate-ids';
    protected $description = 'Generate unique agent IDs for existing agents';

    public function handle()
    {
        $agents = Agent::all();

        foreach ($agents as $agent) {
            $agentId = $this->generateUniqueAgentId();
            $agent->update(['agent_id' => $agentId]);
        }

        $this->info('Unique agent IDs generated successfully.');
    }

    private function generateUniqueAgentId()
    {
        $agentId = 'VET-' . date('Y') . '-' . Carbon::now()->format('dhms') . '-' . mt_rand(1000, 9999);

        while (Agent::where('agent_id', $agentId)->exists()) {
            $agentId = 'VET-' . date('Y') . '-' . Carbon::now()->format('dhms') . '-' . mt_rand(1000, 9999);
        }

        return $agentId;
    }
}
