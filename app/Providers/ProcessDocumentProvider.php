<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ProcessDocumentService;
use Illuminate\Support\ServiceProvider;

class ProcessDocumentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[\Override]
    public function register(): void
    {
        $this->app->singleton(ProcessDocumentService::class, function ($app) {
            return new ProcessDocumentService(config('document'));
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
