<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Twitter;
class SocialServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Twitter::class, function()
        {
            //Using the direct method
          //  return new Twitter('api-key');

            //using the config and env files
            return new Twitter(config('services.twitter.key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
