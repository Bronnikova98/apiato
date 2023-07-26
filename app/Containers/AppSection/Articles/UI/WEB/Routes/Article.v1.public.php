<?php

use App\Containers\AppSection\Articles\UI\WEB\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('articles', [ArticleController::class, 'index'])->name('articles');

Route::get('articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

