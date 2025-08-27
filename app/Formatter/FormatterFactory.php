<?php

declare(strict_types=1);

namespace App\Formatter;

final readonly class FormatterFactory
{
    public function __construct(
        private TableFormatter $table,
        private JsonFormatter $json,
    ) {
        //
    }

    public function make(string $format): Formatter
    {
        return match (strtolower($format)) {
            'json' => $this->json,
            default => $this->table,
        };
    }
}
