<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport::routes(); // moved to OAuthServiceProvider

        /* https://tools.ietf.org/html/draft-ietf-oauth-browser-based-apps-00
         * It is no longer best practice to use the Implicit Grant.
         * This grant is documented here for legacy purposes only.
         * Industry best practice recommends using the Authorization Code Grant without a client secret for native and browser-based apps.
         */

        // Passport::enableImplicitGrant();

        /*
        Passport::tokensExpireIn(now()->addDays(config('passport.token_expiry')));
        Passport::refreshTokensExpireIn(now()->addDays(config('passport.refresh_token_expiry')));
        Passport::personalAccessTokensExpireIn(now()->addMonths(config('passport.personal_access_token_expiry')));*/
    }
}
