<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            if (isset($data['color_ids']) || $data['tag_ids']){
                $colors = $data['color_ids'];
                $tags = $data['tag_ids'];
                unset($data['color_ids'], $data['tag_ids']);
            }


            $product->update($data);
            $product->colors()->sync($colors);
            $product->tags()->sync($tags);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        $categories = Category::all();
        $colors = Color::all();
        $tags = Tag::all();

        return view('product.show', compact('product', 'categories', 'colors', 'tags'));
    }
}
