<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('confirmation/{token}', 'Auth\AuthController@getConfirmation');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('login-as-admin', function () {
    Auth::loginUsingId(1);

    return back();
});
