<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    protected $table = 'bills';
    public $timestamps = false;
    protected $fillable = ['id', 'bill_number', 'user_id', 'category', 'buyer', 'created_at', 'count', 'ad_num'];
}
