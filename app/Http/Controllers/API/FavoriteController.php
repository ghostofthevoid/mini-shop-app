<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Bookmark;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class FavoriteController extends Controller
{
    public function index()
    {
        $ids = Bookmark::select('product_id')->get();
        $products =  Product::whereIn('id', $ids)->get();
        return ProductResource::collection($products);

    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'product_id' => 'integer'
            ]);
            $result = Bookmark::firstOrCreate($data);
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
        return $result;
    }

    public function destroy($bookmarkId)
    {
        
        $bookmark = Bookmark::find($bookmarkId);
        $bookmark->delete();
    }
}
