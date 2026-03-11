<?php

namespace IssueConnector\SubmissionFormConnector;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'submissionform');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/issue-connector.php' => config_path('issue-connector.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/submissionform'),
        ], 'submissionform');
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/issue-connector.php',  // ✅ Fixed: was /../../
            'issue-connector'
        );
    }
}