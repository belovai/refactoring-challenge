<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Formatter\FormatterFactory;
use App\Services\ProcessDocumentService;
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
                                    {--json}
                                    {documentType}
                                    {partnerId}
                                    {total}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process input csv data';

    /**
     * Execute the console command.
     */
    public function handle(
        ProcessDocumentService $processDocumentService,
        ProcessDocumentValidationFactory $validationFactory,
        FormatterFactory $formatterFactory
    ): int {
        $validator = $validationFactory->fromArray(array_merge($this->arguments(), $this->options()));
        $processDocumentRequest = $validator->validate();

        $result = $processDocumentService->process($processDocumentRequest);
        $formatter = $formatterFactory->make($this->option('json') ? 'json' : 'table');

        $formatter->render($result, $this->output);

        return static::SUCCESS;
    }
}
