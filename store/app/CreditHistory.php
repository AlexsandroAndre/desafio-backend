<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    protected $fillable = ['client_id', 'order_id', 'card_number', 'value', 'date'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['date'];
    protected $dateFormat = 'd/m/Y';
    public $timestamps = false;   

    public function transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }
}
