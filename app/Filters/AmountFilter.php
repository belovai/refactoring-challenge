<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Support\Collection;

class AmountFilter
{
    public static function apply(Collection $collection, float $amount): Collection
    {
        return $collection->where('amount', '>', $amount);
    }
}
