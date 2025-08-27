<?php

namespace Nanorocks\DatabaseNewsletter;

use Illuminate\Support\ServiceProvider;
use Nanorocks\DatabaseNewsletter\Drivers\DatabaseDriver;

class NewsletterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'newsletter-migrations');

            $this->publishes([
                __DIR__ . '/../config/newsletter.php' => config_path('newsletter.php'),
            ], 'newsletter-config');
        }
    }

    public function register(): void
    {
        $this->app->bind('newsletter.database', function () {
            return new DatabaseDriver();
        });
    }
}
