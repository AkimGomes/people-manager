<?php

namespace App\Providers;

use App\Repositories\PessoaRepository;
use App\Repositories\PessoaRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PessoaRepositoryInterface::class, PessoaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
