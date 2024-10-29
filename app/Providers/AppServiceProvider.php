<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Providers\TransferAuthorizer\Interfaces\TransferAuthorizerProviderInterace;
use Src\Providers\TransferAuthorizer\TransferAuthorizerProvider;
use Src\Modules\Transferences\Repositories\Interfaces\TransferencesRepositoryInterface;
use Src\Modules\Transferences\Repositories\TransferencesRepository;
use Src\Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Src\Modules\User\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TransferencesRepositoryInterface::class, TransferencesRepository::class);
        $this->app->bind(TransferAuthorizerProviderInterace::class, TransferAuthorizerProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
