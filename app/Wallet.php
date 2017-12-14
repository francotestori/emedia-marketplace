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

    public function debits()
    {
        return $this->hasMany(Transaction::class, 'from_wallet');
    }

    public function credits()
    {
        return $this->hasMany(Transaction::class,'to_wallet');
    }

    public function getCredits()
    {
        return $this->credits()->get();
    }

    public function getDebits()
    {
        return $this->debits()->get();
    }

}
