<?php

use App\Containers\UserSection\Authentication\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('profile/register', [RegisterUserController::class, 'registerTeacher'])
    ->name('teacher.register')
    ->middleware(['web']);
