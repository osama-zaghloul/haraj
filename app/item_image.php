<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class item_image extends Model
{
  public $timestamps = false;
  protected $fillable = ['item_id','image'];

}
