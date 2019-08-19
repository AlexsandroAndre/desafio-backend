<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['client_id', 'client_name', 'value_to_pay', 'card_number'];
    public $timestamps = false;

    public function history()
    {
        return $this->hasOne('App\History');
    }

    public function creditCard()
    {
    	return $this->hasOne('App\CreditCard');
    }
}
