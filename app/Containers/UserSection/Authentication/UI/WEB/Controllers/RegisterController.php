<?php

namespace App\Containers\UserSection\Authentication\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;

class RegisterController extends WebController
{

    public function choose()
    {
        return view('pages.register.choose');
    }

}
