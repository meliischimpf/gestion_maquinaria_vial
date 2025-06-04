<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\AssignmentEnded;
use App\Listeners\SendServiceNotification;
use App\Listeners\ProcessAssignmentEnd;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.   
     */

     protected $listen = 
     [
            Registered::class => [
            SendEmailVerificationNotification::class,
        ],
            AssignmentEnded::class => [ 
            ProcessAssignmentEnd::class,
        ],
    ];


    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }


    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

}
