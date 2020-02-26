<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAgendaRates extends Model
{
    protected $fillable =['value','agenda_rate_questions_id','agenda_rate_options_id','user_id','event_id'];

    public function agendaRateQuestions()
    {
        return $this->belongsTo(AgendaRateQuestions::class)->withDefault();
    }

    public function agendaRateOptions()
    {
        return $this->belongsTo(AgendaRateOptions::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
