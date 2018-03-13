<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function debug()
    {
        return array_values(Product::all()->pluck('size')->unique()->toArray());

    }
}
