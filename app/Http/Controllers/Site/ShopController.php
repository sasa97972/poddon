<?php

namespace App\Http\Controllers\Site;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index($category = "")
    {
        $products = Product::all();
        return view('site.shop', ["category" => $category, "products" => $products]);
    }
}
