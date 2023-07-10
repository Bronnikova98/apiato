<?php

use App\Containers\UserSection\Authentication\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('profile/register-vk', [RegisterUserController::class, 'registerTeacherVk'])
    ->name('teacher.register.vk')
    ->middleware(['web']);
