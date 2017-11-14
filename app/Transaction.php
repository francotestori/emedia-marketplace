<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_id','type', 'credits', 'event_id'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getEvent()
    {
        return $this->event()->first();
    }

    public function getAddspace()
    {
        $event = $this->getEvent();
        if($event != null)
            return $event->getAddspace();
        else return null;
    }
}
