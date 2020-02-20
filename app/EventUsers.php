<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventUsers extends Model
{
    protected $fillable =['attended','user_id','event_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

}
