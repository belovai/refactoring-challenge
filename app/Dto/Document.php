<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\DocumentType;
use Spatie\LaravelData\Data;

class Document extends Data
{
    public function __construct(
        public int $id,
        public DocumentType $document_type,
        public Partner $partner,
        /** @var array<Item> $items */
        public array $items,
        public float $total,
    ) {
        //
    }
}
