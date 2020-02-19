<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionSpeakers extends Model
{
    protected $fillable =['user_id','day_session_id'];

    protected $with=['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
