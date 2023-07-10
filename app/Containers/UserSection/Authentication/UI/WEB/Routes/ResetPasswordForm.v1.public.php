<?php

use Illuminate\Support\Facades\Route;

Route::get('password/reset/form', [\App\Containers\UserSection\Authentication\UI\API\Controllers\ResetPasswordController::class, 'resetPasswordForm'])
    ->middleware(['web'])
    ->name('password.reset.form');

