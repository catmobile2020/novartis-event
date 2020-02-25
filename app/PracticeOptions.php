<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeOptions extends Model
{
    protected $fillable=['option','practice_id'];

    public function practice()
    {
        return $this->belongsTo(Practice::class)->withDefault();
    }

    public function userPractices()
    {
        return $this->hasMany(UserPractices::class,'practice_option_id');
    }

    public function rates()
    {
        return $this->hasMany(PracticeOptionRates::class);
    }
}
