<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    // protected $policies = [
    //     'App\Models\Model' => 'App\Policies\ModelPolicy',
    // ];

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\UserChart::class
        ]);
        Paginator::useBootstrap();
    }
}
