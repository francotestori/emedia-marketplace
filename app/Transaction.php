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
        'from_wallet', 'to_wallet' , 'amount', 'type', 'event_id', 'invoice_id', 'invoice_description'
    ];

    public function sender()
    {
        return $this->hasOne(Wallet::class,'id','from_wallet');
    }

    public function receiver()
    {
        return $this->hasOne(Wallet::class,'id','to_wallet');
    }

    public function getSender()
    {
        return $this->sender()->first();
    }

    public function getReceiver()
    {
        return $this->receiver()->first();
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

        return ($event != null) ? $event->getAddspace() : null;
    }

    public function completed()
    {
        if ($this->type == 'DEPOSIT'){
            return $this->payment_status == 'Completed';
        }
        return true;
    }
}
