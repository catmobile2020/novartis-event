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

    public function rates()
    {
        return $this->hasMany(SessionRates::class);
    }

    public function getTotalRateAttribute()
    {
        return $this->rates()->count()  ? $this->rates()->sum('rate') / $this->rates()->count() : 'Not Have Rate Yet!';
    }
}
