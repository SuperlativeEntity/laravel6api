<?php

namespace App\OAuth;

use App\Models\Passport\Client;
use Dingo\Api\Auth\Auth;
use Illuminate\Auth\CreatesUserProviders;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class OAuthServiceProvider extends ServiceProvider
{
    use CreatesUserProviders;

    public function register()
    {
    }

    public function boot()
    {
        Passport::routes();

        Passport::useClientModel(Client::class);

        Passport::tokensCan([
            'read_user_data' => 'Read user data',
            'write_user_data' => 'Write user data',
        ]);

        $oauthProvider = $this->app->make(OAuth::class);
        $oauthProvider->setUserProvider($this->createUserProvider(config('auth.guards.api.provider')));
        $this->app[Auth::class]->extend('oauth', $oauthProvider);

        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
            $fractal = new \League\Fractal\Manager;
            $fractal->setSerializer(new \League\Fractal\Serializer\JsonApiSerializer());
            return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
        });
        app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Auth\AuthenticationException $exception) {
            return new JsonResponse('Unauthenticated', 401);
        });
    }
}
