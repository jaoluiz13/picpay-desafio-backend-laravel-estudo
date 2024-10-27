<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
