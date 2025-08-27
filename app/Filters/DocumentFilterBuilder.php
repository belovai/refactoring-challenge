<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\DocumentType;
use Illuminate\Support\Collection;

class DocumentFilterBuilder
{
    /**
     * @param  \Illuminate\Support\Collection<int, \App\Dto\Document>  $documents
     */
    public function __construct(private Collection $documents)
    {
        //
    }

    /**
     * @param  \Illuminate\Support\Collection<int, \App\Dto\Document>  $documents
     */
    public static function for(Collection $documents): self
    {
        return new self($documents);
    }

    public function type(DocumentType $type): self
    {
        $this->documents = DocumentTypeFilter::apply($this->documents, $type);

        return $this;
    }

    public function partner(int $id): self
    {
        $this->documents = PartnerFilter::apply($this->documents, $id);

        return $this;
    }

    public function total(float $total): self
    {
        $this->documents = TotalFilter::apply($this->documents, $total);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection<int, \App\Dto\Document>
     */
    public function get(): Collection
    {
        return $this->documents;
    }
}
