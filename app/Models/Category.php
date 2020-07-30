<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
    	'name','slug','image','status'
    ];
    public function fashions(){
    	return $this->belongsToMany('App\Models\Fashion','fashion_category','category_id','fashion_id');
    }
}
