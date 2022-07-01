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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->group(['prefix' => 'api','middleware' => 'auth' ], function() use ($router){
   
     $router->get('me','AuthController@me');
     
});

$router->group(['prefix' => 'api'], function() use ($router){
    
    $router->post('login','AuthController@login');
    $router->post('register', 'AuthController@register');
 
});

$router->group(['prefix' => 'api' ], function() use ($router){
   
    $router->get('getdatatks','TksController@getdatatks');
    $router->get('getdataldr','TksController@getDataLdr');
    $router->get('getdatacr','TksController@getDataCr');
    $router->post('tks/reset','TksController@resettks');
    
    $router->post('getldr','LdrController@getLdr');
    $router->post('ldr/store','LdrController@store');
    $router->post('ldr/update','LdrController@update');
    $router->post('gettransldr','TransTksController@gettransLdr');
    
    $router->post('getcr','CrController@getCr');
    $router->post('cr/store','CrController@store');
    $router->post('cr/update','CrController@update');
    $router->post('gettranscr','TransTksController@gettransCr');

    $router->post('getcar','CarController@getCar');
    $router->post('car/store','CarController@store');
    $router->post('car/update','CarController@update');
    $router->post('gettranscar','TransTksController@gettransCar');
    
});

// Route::group(['prefix' => 'api' ], function ($router) {

   

// });

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });
