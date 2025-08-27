<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Dto\ProcessDocumentResult;
use Illuminate\Console\OutputStyle;

interface Formatter
{
    public function render(ProcessDocumentResult $result, OutputStyle $output): void;
}
