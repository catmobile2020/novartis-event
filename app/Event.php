<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable =['date','city','active'];

    public function users()
    {
        return $this->hasMany(EventUsers::class);
    }
}
