<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable =['date','city','active','address','lat','lng'];

    public function users()
    {
        return $this->hasMany(EventUsers::class);
    }
}
