<?php

namespace App\Containers\UserSection\Authentication\UI\WEB\Controllers;

use App\Containers\UserSection\Authentication\Actions\WebLoginAction;
use App\Containers\UserSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends WebController
{
    /**
     * @return Factory|View|Application
     */
    public function showLoginPage(): Factory|View|Application
    {
        return view('userSection@authentication::login');
//        return view('pages.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            app(WebLoginAction::class)->run($request);
        } catch (Exception $e) {
            return redirect()->route(RouteServiceProvider::LOGIN)->with('login', $e->getMessage());
        }
        return redirect()->intended();
    }
}
