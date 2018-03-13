<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProductRepositories;

class CartController extends Controller
{
    protected $products;

    public function __construct(ProductRepositories $product)
    {
        $this->products = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->session()->has('cart')) {
            return response()->json([], Response::HTTP_OK);
        }
        return response()->json(
            $this->products->getWithImages($request->session()->get('cart')),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->session()->has('cart')) {
            $id = array_search($request->product_id, $request->session()->get('cart'));
            if($id === false) {
                $request->session()->push('cart', $request->product_id);
            }
        } else {
            $request->session()->put('cart', [$request->product_id]);
        }

        return response()->json(
            $this->products->getWithImages($request->session()->get('cart')),
            Response::HTTP_ACCEPTED
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $index = array_search($id, $request->session()->get('cart'));
        if($index === false) return response()->json(null, Response::HTTP_BAD_REQUEST);
        $cart = $request->session()->get('cart');
        unset($cart[$index]);
        $request->session()->put('cart', $cart);

        return response()->json(null, Response::HTTP_OK);
    }
}
