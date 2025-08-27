<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ProcessDocumentResult extends Data
{
    /**
     * @param  array<string>  $headers
     * @param  \Illuminate\Support\Collection<int, \App\Dto\Document>  $documents
     */
    public function __construct(public array $headers, public Collection $documents)
    {
        //
    }
}
