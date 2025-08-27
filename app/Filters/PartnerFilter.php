<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Support\Collection;

class PartnerFilter
{
    public static function apply(Collection $collection, int $partnerId): Collection
    {
        return $collection->where('partner.id', $partnerId);
    }
}
