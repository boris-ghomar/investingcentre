<?php

namespace App\Providers;

use App\Contracts\EmailCipherContract;
use App\Services\EmailCipher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailCipherContract::class, EmailCipher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
