<?php

use App\Containers\UserSection\Authentication\UI\WEB\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginPage'])
    ->name('login')
    ->middleware(['guest']);
