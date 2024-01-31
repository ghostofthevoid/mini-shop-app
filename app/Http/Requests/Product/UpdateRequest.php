<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable',
            'content' => 'nullable',
            'price' => 'required',
            'old_price' => 'nullable',
            'count' => 'nullable|integer',
            'is_published' => 'nullable',
            'category_id' => 'nullable',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'nullable|integer|exists:colors,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
            'preview_image' => 'nullable|file',
            'product_images' => 'nullable|array'
        ];
    }
}
