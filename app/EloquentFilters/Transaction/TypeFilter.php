<?php

namespace App\EloquentFilters\Transaction;

use App\Models\Transaction;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class TypeFilter extends Filter
{

    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('type',Transaction::$type[strtoupper($value)]);
    }
}
