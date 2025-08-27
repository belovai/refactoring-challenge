<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Document;
use App\Dto\ProcessDocumentRequest;
use App\Dto\ProcessDocumentResult;
use App\Filters\DocumentFilterBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProcessDocument
{
    /**
     * @var array<string>
     */
    protected array $header = [];

    /**
     * @param  array<string, string>  $config
     */
    public function __construct(private array $config)
    {
        //
    }

    public function process(ProcessDocumentRequest $request): ProcessDocumentResult
    {
        $documents = DocumentFilterBuilder::for($this->readFile($request->file))
            ->type($request->documentType)
            ->partner($request->partnerId)
            ->total($request->total)
            ->get();

        return new ProcessDocumentResult([
            'document_id',
            'document_type',
            'partner name',
            'total',
        ], $documents);
    }

    /**
     * @return \Illuminate\Support\Collection<int, \App\Dto\Document>
     *
     * @throws \JsonException
     */
    private function readFile(string $file): Collection
    {
        $handle = fopen($file, 'r');
        $documents = new Collection;

        while (($row = fgetcsv($handle, null, $this->config['delimiter'])) !== false) {
            if (! $this->header) {
                $this->header = $row;

                continue;
            }

            $data = array_map(function ($cell) {
                if (is_string($cell) && $this->looksLikeJson($cell) && $this->isValidJson($cell)) {
                    return json_decode($cell, true, flags: JSON_THROW_ON_ERROR);
                }

                return $cell;
            }, $row);

            $assoc = array_combine($this->header, $data);
            $assoc['total'] = $this->calculateAmount($assoc['items'] ?? []);
            $documents->add(Document::from($assoc));
        }

        return $documents;
    }

    /**
     * @param  array<mixed>  $items
     */
    private function calculateAmount(array $items): float
    {
        $sum = 0.0;
        foreach ($items as $item) {
            $sum += (float) data_get($item, 'unit_price', 0) * (float) data_get($item, 'quantity', 0);
        }

        return $sum;
    }

    private function looksLikeJson(string $value): bool
    {
        $value = ltrim($value);

        return Str::startsWith($value, ['{', '[']);
    }

    private function isValidJson(string $value): bool
    {
        if (function_exists('json_validate')) {
            return json_validate($value);
        }
        json_decode($value);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
