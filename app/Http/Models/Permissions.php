<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->belongsToMany(User::class, 'role_permission', 'permission_id', 'role_id');
    }
}
