<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'message', 'created_at'];
}
