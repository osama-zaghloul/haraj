<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $table = 'likes';
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'trader_id'];
}