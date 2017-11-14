<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function addspaces()
    {
        return $this->belongsToMany(Addspace::class);
    }

    public function getAddspaces()
    {
        return $this->addspaces()->get();
    }
}
