<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $fillable = [
        'from_range', 'to_range', 'value'
    ];
}
