<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'title','min','icon_id','mode_id','color','picture','user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function icon()
    {
        return $this->hasOne('App\Icon');
    }

    public function mode()
    {
        return $this->hasOne('App\Mode');
    }
}
