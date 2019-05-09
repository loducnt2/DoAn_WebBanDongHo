<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    protected $table = "trademarks";

    /*public function category(){
    	return $this->belongsTo('App\Category', 'idCategory', 'id');
    }*/
    public function product(){
    	return $this->hasMany('App\Product', 'idTrade', 'id');
    }

}
