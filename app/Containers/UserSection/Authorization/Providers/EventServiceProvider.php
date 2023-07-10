<?php

namespace App\Containers\UserSection\Authorization\Providers;

use App\Containers\UserSection\Authentication\Listeners\RegisterCongratulationListener;
use App\Containers\UserSection\SocialAccount\Listeners\ClearCookieDataListener;
use App\Ship\Parents\Providers\EventServiceProvider as ParentEventServiceProvider;
use Illuminate\Auth\Events\Registered;

/**
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class EventServiceProvider extends ParentEventServiceProvider
{
    /**
     * The event listener mappings for the container.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            RegisterCongratulationListener::class,
            ClearCookieDataListener::class
        ]
    ];
}
