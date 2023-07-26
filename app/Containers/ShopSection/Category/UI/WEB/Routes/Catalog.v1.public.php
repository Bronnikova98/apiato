<?php

use App\Containers\ShopSection\Category\UI\WEB\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('catalog/{category:slug}', [CatalogController::class, 'category'])->name('catalog.category');

Route::get('catalog/{category:slug}/{product:slug}', [CatalogController::class, 'product'])->name('catalog.category.product');
