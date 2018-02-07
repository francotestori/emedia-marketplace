<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditPackage extends Model
{
    protected $fillable = [
        'name', 'amount', 'cost'
    ];

    public function active()
    {
        return $this->active;
    }

}
