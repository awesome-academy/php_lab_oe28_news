<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'title',
        'description',
        'content',
        'hot',
        'category_id',
        'user_id',
        'status',
        'image',
        'slug',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'news_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isAuthUserLikedNews(){
        $like = $this->likes()->where('user_id',  Auth::id());
        if ($like->count() == 0){
            return false;
        }
        return true;
    }
}
