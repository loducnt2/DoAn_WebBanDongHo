<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = "orderdetails";

    public function order(){
        return $this->belongsTo('App\Order', 'idOrder', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'idProduct', 'id');
    }
}
