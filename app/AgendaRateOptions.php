<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaRateOptions extends Model
{
    protected $fillable=['option','agenda_rate_questions_id'];

    public function rateQuestions()
    {
        return $this->belongsTo(AgendaRateQuestions::class)->withDefault();
    }

    public function userRates()
    {
        return $this->hasMany(UserAgendaRates::class,'agenda_rate_questions_id');
    }
}
