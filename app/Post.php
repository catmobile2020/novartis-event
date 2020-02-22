<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['content','user_id'];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable')->withDefault();
    }
    public function getPhotoAttribute()
    {
        if ($this->image->url)
            return $this->image->full_url;
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class);
    }
}
