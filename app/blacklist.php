<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blacklist extends Model
{
    protected $table = 'blacklists';
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'message'];
}
