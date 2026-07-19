<?php

namespace App\Providers;

use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserAccessManagementProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
