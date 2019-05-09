<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    /*public function trade(){
    	return $this->hasMany('App\Trademark', 'idCategory', 'id');
    }
    public function product(){
    	return $this->hasManyThrough('App\Product', 'App\Trademark', 'idCategory', 'idTrade', 'id');
    }*/
    public function product(){
    	return $this->hasMany('App\Product', 'idCategory', 'id');
    }

}
