<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//TODO remove ???
class Message extends Model
{
    protected $fillable = [
        'conversation_id', 'sender', 'message'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }
}
