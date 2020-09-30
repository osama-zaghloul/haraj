<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transfer extends Model
{
     protected $table = 'transfers';
     public $timestamps = false;
     protected $fillable = ['id', 'bill_number', 'name', 'category', 'image', 'bank_name', 'buyer', 'created_at', 'count', 'ad_num'];
}
