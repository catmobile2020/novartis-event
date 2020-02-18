<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable =['title','active'];

    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function options()
    {
        return $this->hasMany(PollOptions::class);
    }

    public function userPolls()
    {
        return $this->hasMany(UserPolls::class);
    }

}
