<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id','balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTransactions()
    {
        return $this->transactions()->get();
    }

    public function getCredits()
    {
        return $this->transactions()->whereIn('type', ['DEPOSIT','CHARGE'])->get();
    }

    public function getDebits()
    {
        return $this->transactions()->whereIn('type', ['WITHDRAWAL','PAYMENT'])->get();
    }

}
