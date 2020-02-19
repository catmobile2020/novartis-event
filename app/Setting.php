<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =['company_name','event_name','address','lat','lng'];
}
