<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ProcessDocumentRequest;

class ProcessDocument
{
    /**
     * @param  array<string, string>  $config
     */
    public function __construct(private array $config)
    {
        //
    }

    public function process(ProcessDocumentRequest $request)
    {

    }
}
