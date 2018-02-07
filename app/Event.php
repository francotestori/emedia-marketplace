<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'addspace_id'
    ];

    public function addspace()
    {
        return $this->belongsTo(Addspace::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function eventThread()
    {
        return $this->hasOne(EventThreads::class);
    }

    public function getAddspace()
    {
        return $this->addspace()->first();
    }

    public function getTransactions()
    {
        return $this->transactions()->get();
    }

    public function getThread()
    {
        $event = $this->eventThread()->first();
        if ($event != null)
            return $event->getThread();

        return null;
    }

    public function rejected()
    {
        return $this->state == 'REJECTED';
    }

    public function rejectedByUser()
    {
        return $this->state == 'USER_REJECTED';
    }

    public function pending()
    {
        return $this->state == 'PENDING';
    }

    public function accepted()
    {
        return $this->state == 'ACCEPTED';
    }
}
