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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('siteTitle', 'HME');
        view()->share('Accountnno', '1103071021002301');
        view()->share('Bank_name', 'MCB');
        view()->share('Account_holder', 'Danyal Ahmed');
    }
}
