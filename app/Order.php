<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public function user(){
        return $this->belongsTo('App\User', 'idUser', 'id');
    }

    public function orderdetail(){
        return $this->hasMany('App\Orderdetail', 'idOrder', 'id');
    }

    public function employee(){
    	return $this->belongsTo('App\Employee', 'idEmployee', 'id');
    }

}
