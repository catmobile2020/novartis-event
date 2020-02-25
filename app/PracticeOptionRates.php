<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeOptionRates extends Model
{
    protected $fillable =['rate','user_id','practice_options_id'];

    public function practiceOptions()
    {
        return $this->belongsTo(PracticeOptions::class)->withDefault();
    }
}
