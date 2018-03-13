<?php

namespace App\Http\Controllers\Site\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Phone;

class FilterController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response([
            "categories" => Category::all(),
            "price" => [
                "max" => Product::max('price'),
                "min" => Product::min('price'),
            ],
            "size" => array_values($products->pluck('size')->unique()->toArray()),
            "material" => array_values($products->pluck('material')->unique()->toArray())
        ]);
    }
}
