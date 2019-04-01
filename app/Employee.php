<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";

    public function order(){
    	return $this->hasMany('App\Order', 'idEmployee', 'id');
    }
}
