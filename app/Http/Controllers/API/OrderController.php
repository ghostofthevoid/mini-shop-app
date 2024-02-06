<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;


class OrderController extends Controller
{
    public function index()
    {


    }

    public function store()
    {
        $data = request()->validate([
            'products' => 'array',
            'totalPrice' => 'integer'
        ]);
       return [];
    }


}
