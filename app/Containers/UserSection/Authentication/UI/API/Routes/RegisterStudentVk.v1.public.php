<?php

use App\Containers\UserSection\Authentication\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('students/register-vk', [RegisterUserController::class, 'registerStudentVk'])
    ->name('students.register.vk')
    ->middleware(['web']);
