<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =['question','active','user_id'];

    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
