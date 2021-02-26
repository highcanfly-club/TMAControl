<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Cookie;

class GDPRAgreementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $encryptCookies) {
            $encryptCookies->disableFor(config('app.gdpr_cookie_name'));
        });

        $this->app['view']->composer('gdpr_index', function (View $view) {
            $cookieConsentConfig = config('app.gdpr_enabled');

            $alreadyConsentedWithCookies = Cookie::has(config('app.gdpr_cookie_name'));

            $view->with(compact('alreadyConsentedWithCookies', 'cookieConsentConfig'));
        });
    }
}
