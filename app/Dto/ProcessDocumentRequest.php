<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\DocumentType;
use Spatie\LaravelData\Data;

class ProcessDocumentRequest extends Data
{
    public function __construct(
        public string $file,
        public DocumentType $documentType,
        public int $partnerId,
        public float $amount,
    ) {
        //
    }
}
