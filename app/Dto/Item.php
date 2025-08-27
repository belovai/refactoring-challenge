<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Item extends Data
{
    public function __construct(
        public string $name,
        public float $unit_price,
        public int $quantity,
    ) {
        //
    }
}
