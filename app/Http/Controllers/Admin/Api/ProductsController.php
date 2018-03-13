<?php

namespace App\Http\Controllers\Admin\Api;

use App\Category;
use App\Product;
use App\Repositories\ProductRepositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
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
        $perPage = $request->get('perPage');
        $sortBy = $request->get('sortBy');
        $sort = $request->get('sort');

        return response()->json($this->products->getWithSortAdmin($perPage, $sortBy, $sort), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response([
            "categories" => Category::orderBy('name')->get(),
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->material = $request->material;
        $product->dynamic = $request->dynamic;
        $product->static = $request->static;
        $product->load = $request->load;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->size = $request->size;
        $product->availability = $request->availability;
        $product->category_id = $request->category_id;
        if($request->file('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->title_image = $path;
        }
        $product->save();

        return response()->json($product->id, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);
        if($product->title_image) {
            $product->title_image = Storage::url($product->title_image);
        }
        return response([
            "categories" => Category::orderBy('name')->get(),
            "product" => $product
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $path = $product->title_image;
        if($request->file('image')) {
            if(Storage::exists("public/".$product->title_image)) {
                Storage::delete("public/".$product->title_image);
            }
            $path = $request->file('image')->store('products', 'public');
        }

        $product->update([
            "title" => $request->title,
            "description" => $request->description,
            "material" => $request->material,
            "dynamic" => $request->dynamic,
            "static" => $request->static,
            "load" => $request->load,
            "price" => $request->price,
            "weight" => $request->weight,
            "size" => $request->size,
            "availability" => (bool)$request->availability,
            "category_id" => $request->category_id,
            'title_image' => $path
        ]);

        return response()->json($request->availability, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
