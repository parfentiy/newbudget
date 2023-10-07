<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use App\Observers\AccountObserver;
use App\Models\Account;
=======
use Illuminate\Support\Facades\Schema;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
<<<<<<< HEAD
     */
    public function register(): void
=======
     *
     * @return void
     */
    public function register()
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        //
    }

    /**
     * Bootstrap any application services.
<<<<<<< HEAD
     */
    public function boot(): void
    {
        //
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        Account::observe(AccountObserver::class);
=======
     *
     * @return void
     */
    public function boot()
    {
        //
	    Schema::defaultStringLength(191);


        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    }
}
