<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    protected $table = 'chats';
    public $timestamps = false;
    protected $fillable = ['id', 'sender_id', 'receiver_id', 'message'];
}
