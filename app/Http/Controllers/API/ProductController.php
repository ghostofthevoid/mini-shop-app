<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {

        $data = request()->validate([
            'byTitle' => 'string',
            'byPriceAsc' => 'string',
            'byPriceDesc' => 'string',
            'searchInput' => 'string'
        ]);

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->get();

        return ProductResource::collection($products);
    }


}
