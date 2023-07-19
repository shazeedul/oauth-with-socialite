<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use App\Services\Socialite\Providers\Test1SocialiteProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('test_auth', function () use ($socialite) {
            $config = config('services.socialite.test1_auth');

            return $socialite->buildProvider(Test1SocialiteProvider::class, $config);
        });
    }
}
