<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment_report extends Model
{
    protected $table = 'comment_reports';
    public $timestamps = false;
    protected $fillable = ['id', 'user_id','com_id', 'message'];
}
