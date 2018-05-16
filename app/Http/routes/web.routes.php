<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('confirmation/{token}', 'Auth\AuthController@getConfirmation');

Route::auth();

Route::get('/home', 'HomeController@index');
