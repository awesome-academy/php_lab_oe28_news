<?php

namespace App\Repositories\User;

use App\Http\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function likesNews($news)
    {
        $news->likes()->attach(Auth::id());
    }

    public function unlikesNews($news)
    {
        $news->likes()->detach(Auth::id());
    }
}
