<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPractices extends Model
{
    protected $fillable = ['practice_option_id','practice_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function practice()
    {
        return $this->belongsTo(Practice::class)->withDefault();
    }

    public function practiceOption()
    {
        return $this->belongsTo(PracticeOptions::class)->withDefault();
    }
}
