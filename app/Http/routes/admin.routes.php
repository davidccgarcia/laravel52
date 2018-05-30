<?php

use Illuminate\Foundation\Http\Middleware\Authorize;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\User;

Route::resource('post', 'PostController');

Route::get('dashboard', function () {
    return '<h1>Welcome to the admin panel</h1>';
});

Route::get('login-as/{id}', function ($id) {
    Auth::loginUsingId($id);

    return redirect('/')->with('admin', 'return to be an administrator user');
});

Route::get('users', function () {
    $users = User::all();

    return view('users.list', compact('users'));
});
