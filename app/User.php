<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['name','email','password','active','bio','type','reset_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'reset_token'
    ];

    protected $appends=['photo'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function image()
    {
        return $this->morphOne('App\Image', 'imageable')->withDefault([
            'url'=>'assets/admin/images/default-avatar.png'
        ]);
    }
    public function getPhotoAttribute()
    {
        return $this->image->full_url;
    }

    public function trash()
    {
        $photo = public_path().$this->image->url;
        if (is_file($photo))
        {
            @unlink($photo);
            $this->image()->delete();
        }
        $this->delete();
    }


    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function scopeOnlySpeakers($q)
    {
        $q->where('type',2);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function polls()
    {
        return $this->hasMany(UserPolls::class);
    }

    public function practices()
    {
        return $this->hasMany(UserPractices::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function practiceOptions()
    {
        return $this->hasMany(PracticeOptionRates::class);
    }


    public function routeNotificationForFcm() {
        return $this->device_token;
    }


}
