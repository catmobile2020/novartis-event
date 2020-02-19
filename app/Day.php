<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable=['date'];

    public function sessions()
    {
        return $this->hasMany(DaySession::class);
    }
}
