<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable =['title','active','has_rate'];

    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function options()
    {
        return $this->hasMany(PracticeOptions::class);
    }

    public function userPractices()
    {
        return $this->hasMany(UserPractices::class);
    }
}
