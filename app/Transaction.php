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
        'wallet_id','type', 'credits', 'event_id', 'invoice_id', 'invoice_description'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function getWallet()
    {
        return $this->wallet()->first();
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

    public function completed()
    {
        if ($this->type == 'DEPOSIT'){
            return $this->payment_status == 'Completed';
        }
        return true;
    }
}
