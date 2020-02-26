<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaRateQuestions extends Model
{
    protected $fillable=['title','type'];

    public function options()
    {
        return $this->hasMany(AgendaRateOptions::class,'agenda_rate_questions_id');
    }

    public function userRates()
    {
        return $this->hasMany(UserAgendaRates::class,'agenda_rate_questions_id');
    }

    public function getTotalRateAttribute()
    {
        $rates_count = count($this->userRates);
        if ($rates_count)
        {
            return $this->userRates()->sum('value')/$rates_count;
        }
        return ;
    }
}
