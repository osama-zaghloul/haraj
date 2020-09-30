<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maincategory extends Model
{
    protected $table = 'maincategories';
    public $timestamps = false;
    protected $fillable = ['id','name','image'];
}
