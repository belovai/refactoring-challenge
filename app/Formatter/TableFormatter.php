<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Dto\Document;
use App\Dto\ProcessDocumentResult;
use Illuminate\Console\OutputStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;

class TableFormatter implements Formatter
{
    #[\Override]
    public function render(ProcessDocumentResult $result, OutputStyle $output): void
    {
        $table = new Table($output);
        $table->setHeaders($result->headers)
            ->setRows($result->documents->map(fn (Document $document) => [
                'id' => (string) $document->id,
                'document_type' => $document->document_type->value,
                'partner' => $document->partner->name,
                'total' => $document->total,
            ])->all());

        $style = new TableStyle;
        $style->setDisplayOutsideBorder(false);
        $style->setHorizontalBorderChars('=');
        $style->setVerticalBorderChars(' ');
        $style->setDefaultCrossingChar('=');
        $style->setCellHeaderFormat('%s');

        $table->setStyle($style);
        $table->render();
    }
}
