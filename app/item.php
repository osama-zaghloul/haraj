<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
  public $timestamps = false;
  protected $fillable = ['artitle', 'price', 'video', 'phone', 'code', 'whatsapp', 'address', 'suspensed', 'details', 'category_id'];
}