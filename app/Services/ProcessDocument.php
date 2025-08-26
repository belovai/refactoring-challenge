<?php

declare(strict_types=1);

namespace App\Services;

class ProcessDocument
{
    /**
     * @param  array<string, string>  $config
     */
    public function __construct(private array $config) {}
}
