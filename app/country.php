<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;
    protected $fillable = ['id', 'name'];
}
