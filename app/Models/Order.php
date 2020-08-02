<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
    	'user_id','total_price','invoice_number','status'
    ];

    public function fashion_order(){
    	return $this->belongsToMany('App\Models\Fashion','fashion_order');
    }
}