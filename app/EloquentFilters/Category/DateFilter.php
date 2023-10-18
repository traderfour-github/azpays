<?php

namespace App\EloquentFilters\Category;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    use FiltersDatesTrait;
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $this->filterDate($builder, $value, 'created_at');
    }
}
