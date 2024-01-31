<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            if (isset($data['product_images'])) {
                $productImages = $data['product_images'];
                unset($data['product_images']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            if (isset($data['color_ids']) || $data['tag_ids']) {
                $colors = $data['color_ids'];
                $tags = $data['tag_ids'];
                unset($data['color_ids'], $data['tag_ids']);
            }

            $product = Product::firstOrCreate(['title' => $data['title']], $data);

            $product->colors()->attach($colors, ['created_at' => new \DateTime('now')]);
            $product->tags()->attach($tags, ['created_at' => new \DateTime('now')]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        if (isset($productImages)) {
            foreach ($productImages as $productImage) {

                $currentImages = ProductImage::where('product_id', $product->id)->get()->count();

                if ($currentImages > 2) break;

                $filePath = Storage::disk('public')->put('/images', $productImage);

                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        return redirect()->route('product.index');
    }
}
