<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commission extends Model
{
    protected $table = 'commissions';
    public $timestamps = false;
    protected $fillable = ['id', 'category_id', 'commission'];
}
