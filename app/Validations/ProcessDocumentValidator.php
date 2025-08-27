<?php

declare(strict_types=1);

namespace App\Validations;

use App\Dto\ProcessDocumentRequest;
use App\Enums\DocumentType;
use App\Rules\ReadableFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProcessDocumentValidator
{
    /**
     * @param  array<string, mixed>  $input
     */
    public function __construct(private array $input)
    {
        //
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'file' => ['required', new ReadableFile],
            'documentType' => ['required', Rule::enum(DocumentType::class)],
            'partnerId' => ['required', 'integer', 'min:1'],
            'total' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function validate(): ProcessDocumentRequest
    {
        $validator = Validator::make($this->input, $this->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return ProcessDocumentRequest::from($validator->validated());
    }
}
