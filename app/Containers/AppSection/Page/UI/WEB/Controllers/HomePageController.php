<?php

namespace App\Containers\AppSection\Page\UI\WEB\Controllers;


use App\Containers\AppSection\Partners\Actions\GetPartnersAction;
use App\Containers\AppSection\Posts\Actions\GetPostsAction;
use App\Containers\AppSection\Sliders\Actions\GetSlidersAction;
use App\Ship\Parents\Controllers\WebController;

class HomePageController extends WebController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sliders = app(GetSlidersAction::class)->run();

        //Список категорий

        $posts = app(GetPostsAction::class)->run();
        $partners = app(GetPartnersAction::class)->run();
        return view('pages.home', compact('sliders', 'posts', 'partners'));
    }
}
