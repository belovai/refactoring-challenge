<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ProcessDocument;
use Illuminate\Support\ServiceProvider;

class ProcessDocumentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[\Override]
    public function register(): void
    {
        $this->app->singleton(ProcessDocument::class, function ($app) {
            return new ProcessDocument(config('document'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
