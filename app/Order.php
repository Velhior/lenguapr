<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tarif(){
        return $this->belongsTo('App\Tariff');
    }
}
