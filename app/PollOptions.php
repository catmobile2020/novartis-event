<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOptions extends Model
{
    protected $fillable=['option','poll_id'];

    public function poll()
    {
        return $this->belongsTo(Poll::class)->withDefault();
    }

    public function userPolls()
    {
        return $this->hasMany(UserPolls::class);
    }

}
