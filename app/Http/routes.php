<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function ($router) {
    require __DIR__ . '/routes/web.routes.php';
});

Route::group([
    'prefix' => 'admin', 
    'middleware' => ['web'], 
    'namespace' => 'Admin'
], function ($router) {
    require __DIR__ . '/routes/admin_auth.routes.php';
});

Route::group([
        'prefix' => 'admin', 
        'middleware' => ['admin'], 
        'namespace' => 'Admin'
    ], function ($router) {
        require __DIR__ . '/routes/admin.routes.php';
});

Route::group([
        'prefix' => 'api', 
        'middleware' => ['api'], 
        'namespace' => 'Api'
    ], function ($router) {
    require __DIR__ . '/routes/api.routes.php';
});
