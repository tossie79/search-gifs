<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\HttpClientInterface;
use App\Services\GiphyGuzzleClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HttpClientInterface::class,GiphyGuzzleClient::class);
    }
}
