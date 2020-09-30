<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class member extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $table = 'members';
    protected $fillable = [
        'name', 'country_id', 'phone', 'password', 'user_hash', 'firebase_token', 'forgetcode', 'remember_token', 'suspensed', 'city_id', 'connect', 'likes'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
