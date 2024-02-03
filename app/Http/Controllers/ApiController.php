<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;


class ApiController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function filter()
    {

        $data = request()->validate([
            'value' => 'string'
        ]);
        if ($data['value'] == '-price') {
            $products = Product::orderBy('price', 'desc')->get();
            return ProductResource::collection($products);
        }
        $products = Product::orderBy($data['value'])->get();


        return ProductResource::collection($products);
    }

}
