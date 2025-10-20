<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin\Cliente;
use App\para_el_observador\ClienteHobserver;

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
        Cliente::observe(ClienteHobserver::class);
    }
}
