<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
<<<<<<< HEAD
     */
    public function boot(): void
=======
     *
     * @return void
     */
    public function boot()
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
