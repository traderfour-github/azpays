<?php

namespace App\EloquentFilters\Tag;

use Fouladgar\EloquentBuilder\Concerns\SortableTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends Filter
{
    use SortableTrait;

    protected array $sortable = [
        'id','created_at'
    ];

    public function apply(Builder $builder, mixed $value): Builder
    {
        return $this->applySort($builder, $value);
    }
}
