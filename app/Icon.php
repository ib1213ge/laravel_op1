<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable = ['icon_name'];

    public function timer()
    {
        return $this->belongsTo('App\Timer');
    }
}
