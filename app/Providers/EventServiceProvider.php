<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\Order;
use App\Models\Orders;
use App\Observers\OrderObserver;

class EventServiceProvider extends ServiceProvider
{
    // protected $listen = [];
    protected $listen = [
        'App\Events\OrderCompleted' => [
            'App\Listeners\UpdateAgentPoints',
        ],
    ];
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        Orders::observe(OrderObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

