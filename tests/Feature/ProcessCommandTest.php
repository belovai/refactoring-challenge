<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function Tests\Support\makeCsv;

class ProcessCommandTest extends TestCase
{
    #[Test]
    public function prints_a_table_and_exits_0(): void
    {
        $path = makeCsv(
            ['id', 'document_type', 'partner', 'items'],
            [
                ['1', 'invoice', '{"id":1, "name": "Kovács József"}', '[{"name":"alma","unit_price":5000, "quantity":5}]'],
            ]
        );

        $this->artisan('process', [
            'documentType' => 'invoice',
            'partnerId' => 1,
            'total' => 1,
            '--file' => $path,
        ])
            ->expectsOutputToContain('document_type')
            ->expectsOutputToContain('Kovács')
            ->assertExitCode(0);
    }
}
