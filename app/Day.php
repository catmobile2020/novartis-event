<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable=['date','active'];

    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function sessions()
    {
        return $this->hasMany(DaySession::class);
    }
}
