<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\MetaTagComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('layouts.base', MetaTagComposer::class);
    }
}
