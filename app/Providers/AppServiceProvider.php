<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\ServiceProvider;
use App\Models\Job;
use App\Observers\JobObserver;
use App\Observers\ArticleObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
