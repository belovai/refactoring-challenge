<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Partner extends Data
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {
        //
    }
}
