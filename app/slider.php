<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    protected $table = 'sliders';
    public $timestamps = false;
    protected $fillable = ['id', 'artitle', 'url', 'suspensed', 'image', 'text'];
}