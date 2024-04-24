<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        //blade directive - format money
        Blade::directive('fmoney', function ($money) {
            return "<?php  echo number_format($money,2); ?>";
        });


        //auth gates
        Gate::define('admin', function (User $user) {
            return $user->user_role === 'SYS_ADMIN';
        });

        Gate::define('branch', function (User $user) {
            return $user->user_role === 'BRANCH_PASTOR';
        });

        Gate::define('zonal', function (User $user) {
            return $user->user_role === 'ZONAL_OVERSEER';
        });

        Gate::define('divisional', function (User $user) {
            return $user->user_role === 'DIVISIONAL_OVERSEER';
        });



    }
}
