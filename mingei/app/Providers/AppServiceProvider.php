<?php

namespace App\Providers;

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
        require_once app_path('Helpers/NumberHelper.php');
        require_once app_path('Helpers/GetS3TemporaryUrl.php');
        require_once app_path('Helpers/CreateNotification.php');
        require_once app_path('Helpers/GetUnreadNotificationCount.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
