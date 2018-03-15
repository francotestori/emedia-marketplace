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

    public function getTransactions()
    {
        return $this->getCredits()->merge($this->getDebits());
    }

    public function getUser()
    {
        return $this->user()->first();
    }

    public function getTransactionsBalance()
    {
        if($this->getUser()->isManager())
            return $this->getRevenues()->reduce(function($transaction){
                return $transaction['amount'];
            });

        $credit = 0;
        $debit = 0;

        foreach($this->getCredits() as $single_credit){
            if($single_credit->getEvent() == null ||
                ($single_credit->getEvent() != null && $single_credit->getEvent()->accepted()))
                $credit += $single_credit->amount;
        }

        foreach($this->getDebits() as $single_debit){
            if($single_debit->getEvent() == null ||
                ($single_debit->getEvent() != null && $single_debit->getEvent()->accepted()))
                $debit += $single_debit->amount;
        }

        return $credit - $debit;
    }

    public function getRevenues()
    {
        $revenues = $this->credits()
                    ->whereNotNull('event_id')
                    ->where('type', 'PAYMENT')
                    ->get();

        return $revenues->filter(function($revenue){
            return $revenue->getEvent() != null && $revenue->getEvent()->accepted();
        });

    }


}
