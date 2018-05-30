<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return true;
    }

    public function update(User $user, Post $post)
    {
        return $user->isAuthor($post);
    }

    public function admin()
    {
        return true;
    }
}
