<?php

use Illuminate\Foundation\Http\Middleware\Authorize;
use App\Post;

Route::resource('post', 'PostController');

Route::get('dashboard', function () {
    return '<h1>Welcome to the admin panel</h1>';
});
