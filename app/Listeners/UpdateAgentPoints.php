<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Models\Agent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;


class UpdateAgentPoints implements ShouldQueue
{

    protected $order;
    protected $agent;

    public function __construct(OrderCompleted $event)
    {
        $this->order = $event->order;
        $this->agent = Agent::find($this->order->agent_id);
    }

    public function handle(OrderCompleted $event)
    {
        $order = $event->order;
        $totalAmount = $order->total_amount;
        $points = 0;

        // Calculate points based on total amount
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

        // Update agent's points
        $this->agent->points += $points;
        $this->agent->save();
        // Update agent's points if the agent is found
        // if ($this->agent) {
        //     $this->agent->points += $points;
        //     $this->agent->save();
        // } else {
        //     // Handle case where agent is not found
        //     Log::error('Agent not found for order: ' . $order->id);
        // }
    }

    // public function __construct()
    // {
    //     //
    // }

    // public function handle(OrderCompleted $event)
    // {
    //     $order = $event->order;
    //     $totalAmount = $order->total_amount;
    //     $points = 0; //intiate points

    //     // Calculate points based on total amount
    //     if ($totalAmount >= 1 && $totalAmount <= 10000) {
    //         $points = 10;
    //     } elseif ($totalAmount >= 11000 && $totalAmount <= 20000) {
    //         $points = 20;
    //     } elseif ($totalAmount >= 21000 && $totalAmount <= 30000) {
    //         $points = 30;
    //     } elseif ($totalAmount >= 31000 && $totalAmount <= 40000) {
    //         $points = 40;
    //     } elseif ($totalAmount >= 41000 && $totalAmount <= 50000) {
    //         $points = 50;
    //     } elseif ($totalAmount >= 51000 && $totalAmount <= 60000) {
    //         $points = 60;
    //     }

    //     // Update agent's points
    //     $agent = $order->agent;
    //     $agent->points += $points;
    //     $agent->save();
    // }
}
