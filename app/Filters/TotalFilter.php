<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Support\Collection;

class TotalFilter
{
    /**
     * @param  \Illuminate\Support\Collection<int, \App\Dto\Document>  $collection
     * @return \Illuminate\Support\Collection<int, \App\Dto\Document>
     */
    public static function apply(Collection $collection, float $total): Collection
    {
        return $collection->where('total', '>', $total);
    }
}
