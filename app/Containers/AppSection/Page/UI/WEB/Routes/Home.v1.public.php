
<?php

use App\Containers\AppSection\Page\UI\WEB\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');

