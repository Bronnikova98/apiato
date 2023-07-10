<?php

use App\Containers\UserSection\Authentication\UI\WEB\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('front/register/choose', [RegisterController::class, 'choose'])
    ->name('front.register.choose')
    ->middleware(['web']);

