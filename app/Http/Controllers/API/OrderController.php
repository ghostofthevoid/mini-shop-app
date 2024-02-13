<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\Product\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {


    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'products' => 'required|array',
                'totalPrice' => 'required|integer'
            ]);
            $order = Order::firstOrCreate([
                'products' => json_encode($data['products']),
                'total_price' => $data['totalPrice']
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
        return $order;
    }


}
