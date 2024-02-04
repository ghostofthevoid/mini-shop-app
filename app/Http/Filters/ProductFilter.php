<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    const CATEGORIES = 'categories';
    const COLORS = 'colors';
    const PRICES = 'prices';
    const TAGS = 'tags';
    const PRICE_ASC = 'byPriceAsc';
    const PRICE_DESC = 'byPriceDesc';
    const TITLE = 'byTitle';
    const SEARCH_INPUT = 'searchInput';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, 'categories'],
            self::COLORS => [$this, 'colors'],
            self::PRICES => [$this, 'prices'],
            self::TAGS => [$this, 'tags'],
            self::PRICE_ASC => [$this, 'filterByPriceAsc'],
            self::PRICE_DESC => [$this, 'filterByPriceDesc'],
            self::TITLE => [$this, 'filterByTitle'],
            self::SEARCH_INPUT => [$this, 'searchInput'],

        ];
    }

    public function searchInput(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%") ||
        $builder->where('description', 'like', "%{$value}%") ||
        $builder->where('content', 'like', "%{$value}%");
    }

    public function filterByTitle(Builder $builder, $value)
    {
        $builder->orderBy($value);
    }

    public function filterByPriceAsc(Builder $builder, $value)
    {
        $builder->orderBy($value);
    }

    public function filterByPriceDesc(Builder $builder)
    {
        $builder->orderBy('price', 'desc');
    }

    protected function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    protected function colors(Builder $builder, $value)
    {
        $builder->whereHas('colors', function ($b) use ($value) {
            $b->whereIn('color_id', $value);
        });
    }

    protected function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price', $value);
    }

    protected function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($b) use ($value) {
            $b->whereIn('tag_id', $value);
        });


    }
}
