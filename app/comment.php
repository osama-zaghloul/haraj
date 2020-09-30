<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [ 'item_id', 'user_id', 'content', 'created_at'];
}