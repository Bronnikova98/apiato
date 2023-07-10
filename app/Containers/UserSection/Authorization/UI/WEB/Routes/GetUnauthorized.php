<?php

use App\Containers\UserSection\Authorization\UI\WEB\Controllers\UnauthorizedController;
use Illuminate\Support\Facades\Route;

Route::get('/unauthorized', [UnauthorizedController::class, 'showUnauthorizedPage'])
    ->name('unauthorized');
