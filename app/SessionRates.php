<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionRates extends Model
{
    protected $fillable = ['rate','comment','user_id','day_session_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
