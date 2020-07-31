<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FashionOrder extends Model
{
    //
    protected $table = 'fashion_order';
    protected $fillable = [
    	'fashion_id','order_id','quantity'
    ];
}
