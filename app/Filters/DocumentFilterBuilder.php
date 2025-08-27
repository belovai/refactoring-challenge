<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\DocumentType;
use Illuminate\Support\Collection;

class DocumentFilterBuilder
{
    public function __construct(private Collection $documents)
    {
        //
    }

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

    public function amount(float $amount): self
    {
        $this->documents = AmountFilter::apply($this->documents, $amount);

        return $this;
    }

    public function get(): Collection
    {
        return $this->documents;
    }
}
