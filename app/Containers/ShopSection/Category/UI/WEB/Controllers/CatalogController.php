<?php

namespace App\Containers\ShopSection\Category\UI\WEB\Controllers;

use App\Containers\ShopSection\Category\Actions\GetCategoriesAction;
use App\Containers\ShopSection\Category\Models\Category;
use App\Containers\ShopSection\Product\Models\Product;
use App\Ship\Parents\Controllers\WebController;

class CatalogController extends WebController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = app(GetCategoriesAction::class)->run();


        return view('pages.catalog', compact('categories'));
    }

    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->getKey())->paginate(1);
        return view('pages.category', compact('category', 'products'));
    }

    public function product()
    {
//        return view('pages.product');
    }
}
