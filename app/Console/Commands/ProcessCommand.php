<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ProcessDocument;
use App\Validations\ProcessDocumentValidationFactory;
use Illuminate\Console\Command;

class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process {--f|file=document_list.csv}
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
    public function handle(ProcessDocument $processDocument, ProcessDocumentValidationFactory $validationFactory): int
    {
        $validator = $validationFactory->fromArray(array_merge($this->arguments(), $this->options()));
        $processDocumentRequest = $validator->validate();

        $processDocument->process($processDocumentRequest);

        return static::SUCCESS;
    }
}
