<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'username',
        'password',
        'role_id',
        'active',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(News::class, 'likes', 'user_id', 'news_id');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
