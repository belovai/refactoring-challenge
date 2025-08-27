<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ProcessDocumentRequest;
use App\Filters\DocumentFilterBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProcessDocument
{
    /**
     * @param  array<string, string>  $config
     */
    public function __construct(private array $config)
    {
        //
    }

    public function process(ProcessDocumentRequest $request): Collection
    {
        return DocumentFilterBuilder::for($this->readFile($request->file))
            ->type($request->documentType)
            ->partner($request->partnerId)
            ->amount($request->amount)
            ->get();
    }

    private function readFile(string $file): Collection
    {
        $handle = fopen($file, 'r');
        $header = [];
        $documents = new Collection;

        while (($row = fgetcsv($handle, null, $this->config['delimiter'])) !== false) {
            if (! $header) {
                $header = $row;

                continue;
            }

            $data = array_map(function ($cell) {
                if (is_string($cell) && $this->looksLikeJson($cell) && $this->isValidJson($cell)) {
                    return json_decode($cell, true, flags: JSON_THROW_ON_ERROR);
                }

                return $cell;
            }, $row);

            $assoc = array_combine($header, $data);
            $assoc['amount'] = $this->calculateAmount($assoc['items'] ?? []);
            $documents->add($assoc);
        }

        return $documents;
    }

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
