<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function debug()
    {
        $product = new Product();

        $product->title = "123";
        $product->description = "123";
        $product->material = "123";
        $product->dynamic = "123";
        $product->static = "123";
        $product->load = "123";
        $product->price = "123";
        $product->weight = "123";
        $product->size = "123";
        $product->availability = true;
        $product->category_id = "1";
        $product->save();

    }
}
