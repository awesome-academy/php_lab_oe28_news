<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function likesNews($news);

    public function unlikesNews($news);

    public function getNotification($id);
}
