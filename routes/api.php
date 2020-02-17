<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* @var \Dingo\Api\Routing\Router $api */
$api = app(\Dingo\Api\Routing\Router::class);

$api->group([
    'namespace' => 'App\Http\Controllers',
    'version' => 'v1',
    'middleware' => 'api.auth',
    'scopes' => ['read_user_data', 'write_user_data'],
], function (\Dingo\Api\Routing\Router $api) {

    $api->get('/posts', function () {
        return response()->json([
            'data' => [
                [
                    'type' => 'post',
                    'id' => 1,
                    'attributes' => [
                        'title' => 'Test 001',
                        'file' => 'https://via.placeholder.com/150',
                        'created_at' => '2020-01-15 12:59:59',
                        'updated_at' => '2020-01-15 12:59:59',
                    ],
                    'relationships' => [
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'included' => [
                [
                    'type' => 'user',
                    'id' => 1,
                    'attributes' => [
                        'name' => 'John Doe',
                        'email' => 'johndoe@example.com',
                    ]
                ]
            ],
            'meta' => [
                'pagination' => [
                    'total' => 1,
                    'count' => 1,
                    'per_page' => 10,
                    'current_page' => 1,
                    'total_pages' => 1,
                ]
            ],
            'links' => [
                'self' => 'http://api.tutorial.test/api/posts?page=1',
                'first' => 'http://api.tutorial.test/api/posts?page=1',
                'last' => 'http://api.tutorial.test/api/posts?page=1'
            ]
        ]);
    });

});
