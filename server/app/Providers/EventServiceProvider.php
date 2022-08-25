<?php

namespace App\Providers;

use App\Events\AdminUpdate;
use App\Events\EmailVerification;
use App\Events\UserEmailVerification;
use App\Listeners\AdminUpdateLogging;
use App\Listeners\EmailVerificationLogging;
use App\Listeners\UserEmailVerificationLogging;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AdminUpdate::class => [
            AdminUpdateLogging::class
        ],
        EmailVerification::class => [
            EmailVerificationLogging::class
        ],
        UserEmailVerification::class => [
            UserEmailVerificationLogging::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
