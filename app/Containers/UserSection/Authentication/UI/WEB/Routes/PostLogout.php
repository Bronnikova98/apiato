<?php

use App\Containers\UserSection\Authentication\UI\WEB\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [LogoutController::class, 'logout'])
    ->name('post_logout');
