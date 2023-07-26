<?php

use App\Containers\AppSection\Posts\UI\WEB\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('news', [PostController::class, 'index'])->name('news');

Route::get('news/{news:slug}', [PostController::class, 'show'])->name('news.show');
