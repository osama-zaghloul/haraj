<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $table = 'reports';
    public $timestamps = false;
    protected $fillable = ['id', 'ad_num', 'message'];
}
