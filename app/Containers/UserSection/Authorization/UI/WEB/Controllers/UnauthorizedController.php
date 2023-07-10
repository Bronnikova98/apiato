<?php

namespace App\Containers\UserSection\Authorization\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UnauthorizedController extends WebController
{
    /**
     * @return Factory|View|Application
     */
    public function showUnauthorizedPage(): Factory|View|Application
    {
        return view('userSection@authorization::unauthorized');
    }
}
