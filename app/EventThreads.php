<?php

namespace App;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Model;

class EventThreads extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 'thread_id'
    ];

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function getThread(){
        return $this->thread()->first();
    }

    public function getEvent(){
        return $this->event()->first();
    }
}
