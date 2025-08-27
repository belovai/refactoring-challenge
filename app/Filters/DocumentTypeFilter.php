<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\DocumentType;
use Illuminate\Support\Collection;

class DocumentTypeFilter
{
    /**
     * @param  \Illuminate\Support\Collection<int, \App\Dto\Document>  $collection
     * @return \Illuminate\Support\Collection<int, \App\Dto\Document>
     */
    public static function apply(Collection $collection, DocumentType $documentType): Collection
    {
        return $collection->where('document_type', $documentType->value);
    }
}
