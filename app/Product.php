<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function trade(){
    	return $this->belongsTo('App\Trademark', 'idTrade', 'id');
    }

    public function image(){
    	return $this->hasMany('App\Image', 'idProduct', 'id');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand', 'idBrand', 'id');
    }

    public function cmt(){
    	return $this->hasMany('App\Comment', 'idProduct', 'id');
    }

    public function listcmt(){
        return $this->hasManyThrough('App\ListComment', 'App\Comment', 'idProduct', 'idComment', 'id');
    }
}
