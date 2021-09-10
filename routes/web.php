<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/register', 'AppController@registerApp');
$router->post('/check-subscription', 'AppController@checkSubscription');
$router->post('/purchase', 'AppController@purchase');
$router->post('/purchase-api', 'ApiController@purchase');
