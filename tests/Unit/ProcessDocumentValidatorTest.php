<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Dto\ProcessDocumentRequest;
use App\Enums\DocumentType;
use App\Validations\ProcessDocumentValidationFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProcessDocumentValidatorTest extends TestCase
{
    #[Test]
    public function builds_dto_on_valid_input(): void
    {
        $data = [
            'file' => tempnam(sys_get_temp_dir(), 'csv'),
            'documentType' => 'invoice',
            'partnerId' => 42,
            'total' => 100,
        ];
        $dto = app(ProcessDocumentValidationFactory::class)->fromArray($data)->validate();
        $this->assertInstanceOf(ProcessDocumentRequest::class, $dto);
        $this->assertEquals($data['file'], $dto->file);
        $this->assertEquals(DocumentType::Invoice, $dto->documentType);
        $this->assertEquals($data['partnerId'], $dto->partnerId);
        $this->assertEquals($data['total'], $dto->total);
    }
}
