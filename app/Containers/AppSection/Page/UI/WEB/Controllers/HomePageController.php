<?php

namespace App\Containers\AppSection\Page\UI\WEB\Controllers;

use App\Containers\AppSection\Page\Actions\CreatePageAction;
use App\Containers\AppSection\Page\Actions\DeletePageAction;
use App\Containers\AppSection\Page\Actions\FindPageByIdAction;
use App\Containers\AppSection\Page\Actions\GetAllPagesAction;
use App\Containers\AppSection\Page\Actions\UpdatePageAction;
use App\Containers\AppSection\Page\UI\WEB\Requests\CreatePageRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\DeletePageRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\EditPageRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\FindPageByIdRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\GetAllPagesRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\StorePageRequest;
use App\Containers\AppSection\Page\UI\WEB\Requests\UpdatePageRequest;
use App\Ship\Parents\Controllers\WebController;

class HomePageController extends WebController
{
    public function index()
    {
        dd(1323);
//        $pages = app(GetAllPagesAction::class)->run($request);

    }

}
