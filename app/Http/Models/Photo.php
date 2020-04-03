<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = [
        'news_id',
        'name',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
