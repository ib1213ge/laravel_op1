<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    protected $fillable = ['mode_name'];

    public function timer()
    {
        return $this->belongsTo('App\Timer');
    }
}
