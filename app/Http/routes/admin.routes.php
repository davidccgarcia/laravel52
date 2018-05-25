<?php

use Illuminate\Foundation\Http\Middleware\Authorize;
use App\Post;

Route::resource('post', 'PostController');

// Route::get('dashboard', function () {
//     return '<h1>Welcome to the admin panel</h1>';
// });

// Route::get('posts', function () {
//     return "[List of posts]";
// })->middleware(Authorize::class . ':view,' . Post::class);

// Route::get('post/create', function () {
//     return "[create a post - form]";
// });

// Route::post('post', function () {
//     return "[Store a post in the DB]";
// });

// Route::get('post/{slug}/edit', function (Post $slug) {
//     return "[Edit post $slug->title]";
// })->middleware(Authorize::class . ':edit,slug');

// Route::put('post/{post}', function ($post) {
//     return "[Update post in the DB]";
// });

// Route::delete('post/{post}', function ($post) {
//     return "[Delete post # post]";
// });
