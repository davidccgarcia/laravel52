<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'registration_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeSearch($q, $value)
    {
        $q->when($value, function ($q) use ($value) {
            return $q->where('email', $value);
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function isAuthor(Post $post)
    {
        return $this->id == $post->author_id;
    }

    public function isCollaborator()
    {
        return $this->id != 1;
    }

    public function isAdmin()
    {
        return $this->email == 'admin@gmail.com';
    }

}
