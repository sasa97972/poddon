<?php


namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepositories
{
    /**
     * Поиск товара с пагинацией и сортировкой, поиск по (названию товара и категории)
     * @param $word
     * @param $perPage
     * @param $sortBy
     * @param $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($word, $perPage, $sortBy, $sort)
    {
        return Product::with('category')
            ->select('products.*', 'categories.name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('title', 'like', "%$word%")
            ->orWhere('categories.name', 'like', "%$word%")
            ->orderBy($sortBy, $sort)
            ->paginate($perPage);
    }

    /**
     * Получить товары с пагинацией и сортировкой
     * @param $perPage
     * @param $sortBy
     * @param $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithSort($perPage, $sortBy, $sort)
    {
        return Product::with('category')
            ->select('products.*', 'categories.name')
            ->where('products.availability', '=', '1')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->orderBy($sortBy, $sort)
            ->groupBy('products.id')
            ->paginate($perPage);
    }

    public function getWithSortAdmin($perPage, $sortBy, $sort)
    {
        return Product::with('category')
            ->select('products.*', 'categories.name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->orderBy($sortBy, $sort)
            ->groupBy('products.id')
            ->paginate($perPage);
    }

    /**
     * Получить все товары с сортировкой
     * @param $sortBy
     * @param $sort
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getAllWithSort($sortBy, $sort)
    {
        return Product::with('category')
            ->select('products.*', 'categories.name')
            ->where('products.availability', '=', '1')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->orderBy($sortBy, $sort)
            ->groupBy('products.id')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getWithImages($id)
    {
        $products = Product::findOrFail($id);
        foreach ($products as $product) {
            $product->title_image = Storage::url($product->title_image);
        }
        return $products;
    }
}