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

    private function isEventlessCreditCompleted($credit)
    {
        return $credit->getEvent() == null && $credit->payment_status == 'Completed';
    }

    public function getTransactionsBalance()
    {
        if($this->getUser()->isManager())
            return $this->getRevenues()->reduce(function($transaction){
                return $transaction['amount'];
            });

        $credit_balance = 0;
        $debit_balance = 0;

        foreach($this->getCredits() as $credit)
        {
            if($this->isEventlessCreditCompleted($credit) ||
               ($credit->getEvent() != null && $credit->getEvent()->accepted()))
                $credit_balance += $credit->amount;
        }

        foreach($this->getDebits() as $single_debit){
            if($single_debit->getEvent() == null ||
                ($single_debit->getEvent() != null && $single_debit->getEvent()->accepted()))
                $debit_balance += $single_debit->amount;
        }

        return $credit_balance - $debit_balance;
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
