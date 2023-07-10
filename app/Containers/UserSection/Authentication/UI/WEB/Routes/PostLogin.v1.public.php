<?php

use App\Containers\UserSection\Authentication\UI\WEB\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])
    ->name('login_post_form');

