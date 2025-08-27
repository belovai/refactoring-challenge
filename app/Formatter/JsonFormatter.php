<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Dto\Document;
use App\Dto\ProcessDocumentResult;
use Illuminate\Console\OutputStyle;

class JsonFormatter implements Formatter
{
    #[\Override]
    public function render(ProcessDocumentResult $result, OutputStyle $output): void
    {
        $output->writeln(json_encode([
            'headers' => $result->headers,
            'documents' => $result->documents->map(fn (Document $document) => [
                'id' => (string) $document->id,
                'document_type' => $document->document_type->value,
                'partner' => $document->partner->name,
                'total' => $document->total,
            ])->all(),
        ]));
    }
}
