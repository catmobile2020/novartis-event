<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaySession extends Model
{
    protected $fillable =['title','location','time_from','time_to','day_id'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function speakers()
    {
        return $this->hasMany(SessionSpeakers::class);
    }
}
