<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $fillable=['content','post_id','user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
