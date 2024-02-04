<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;


class ApiController extends Controller
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
