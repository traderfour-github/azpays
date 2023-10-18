<?php


namespace App\EloquentFilters\Transaction;


use Fouladgar\EloquentBuilder\Concerns\SortableTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends Filter
{
    use SortableTrait;

    protected array $sortable = [
        'id', 'amount','date','trace_number'
    ];

    public function apply(Builder $builder, mixed $value): Builder
    {
        return $this->applySort($builder, $value);
    }
}
