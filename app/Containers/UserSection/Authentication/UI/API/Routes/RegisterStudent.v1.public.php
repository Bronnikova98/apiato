<?php

use App\Containers\UserSection\Authentication\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('students/register', [RegisterUserController::class, 'registerStudent'])
    ->middleware(['web'])
    ->name('students.register');
