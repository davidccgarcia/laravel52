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

Route::get('vuejs', function () {
    return view('vuejs');
});

Route::get('edit-profile', 'ProfileController@edit');
Route::put('edit-profile', 'ProfileController@update');
