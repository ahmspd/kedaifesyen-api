<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    //
    protected $table = 'fashion';
    protected $fillable = [
    	'title','slug','description','store','image','price','weight','stock','status'
    ];

    public function categories(){
    	return $this->belongsToMany('App\Models\Category','fashion_category');
    }
}
