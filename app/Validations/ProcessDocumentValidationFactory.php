<?php

declare(strict_types=1);

namespace App\Validations;

class ProcessDocumentValidationFactory
{
    /**
     * @param  array<string, mixed>  $input
     */
    public function fromArray(array $input): ProcessDocumentValidator
    {
        return new ProcessDocumentValidator($input);
    }
}
