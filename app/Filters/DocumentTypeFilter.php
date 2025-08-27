<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\DocumentType;
use Illuminate\Support\Collection;

class DocumentTypeFilter
{
    public static function apply(Collection $collection, DocumentType $documentType): Collection
    {
        return $collection->where('document_type', $documentType->value);
    }
}
