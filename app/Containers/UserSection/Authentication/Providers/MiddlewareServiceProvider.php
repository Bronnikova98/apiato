<?php

namespace App\Containers\UserSection\Authentication\Providers;

use App\Containers\UserSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Ship\Parents\Providers\MiddlewareServiceProvider as ParentMiddlewareServiceProvider;

class MiddlewareServiceProvider extends ParentMiddlewareServiceProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [
        'guest' => RedirectIfAuthenticated::class,
    ];
}
