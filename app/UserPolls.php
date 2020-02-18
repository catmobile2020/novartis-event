<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPolls extends Model
{
    protected $fillable = ['poll_options_id','poll_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class)->withDefault();
    }

    public function pollOption()
    {
        return $this->belongsTo(PollOptions::class,'poll_options_id')->withDefault();
    }

}
