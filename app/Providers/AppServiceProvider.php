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
        view()->share('FullsiteTitle', 'House of Modern English');
        view()->share('Accountnno', '0110 0100983187');
        view()->share('Bank_name', 'Meezan Bank');
        view()->share('Account_holder', 'Syed Abdul Rehman Khan');
    }
}
