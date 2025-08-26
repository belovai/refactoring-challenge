<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ProcessDocument;
use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process {--file=docker-compose.yaml}
                                    {documentType}
                                    {partnerId}
                                    {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process input csv data';

    /**
     * Execute the console command.
     */
    public function handle(ProcessDocument $processDocument): int
    {

        return static::SUCCESS;
    }
}
