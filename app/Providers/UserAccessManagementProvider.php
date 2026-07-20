<?php

namespace App\Providers;

use App\ValueChainMap\UserAccessManagement\UserManagement\Application\Contracts\UserServiceInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Application\Services\UserService;
use App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Repositories\UserRepositoryInterface;
use App\ValueChainMap\UserAccessManagement\UserManagement\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class UserAccessManagementProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Service Bindings
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerRateLimiters();
    }

    /** All limiter setting for access and user management should be defined here */
    protected function registerRateLimiters(): void
    {
        // Registration limit
        RateLimiter::for('user.register', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

    }
}
