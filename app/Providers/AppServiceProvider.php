<?php

namespace App\Providers;

use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\Entrevista;
use App\Models\Exame;
use App\Models\HistoricoCorpo;
use App\Models\Laudo;
use App\Models\Responsavel;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        RateLimiter::for("login", function () {
            Limit::perMinute(5);
        });
        
        Corpo::observe(\App\Observers\GenericObserver::class);
        Endereco::observe(\App\Observers\GenericObserver::class);
        Responsavel::observe(\App\Observers\GenericObserver::class);
        Entrevista::observe(\App\Observers\GenericObserver::class);
        Exame::observe(\App\Observers\GenericObserver::class);
        Laudo::observe(\App\Observers\GenericObserver::class);
        
    }
}
