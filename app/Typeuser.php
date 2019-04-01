<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typeuser extends Model
{
    protected $table = "typeusers";

    public function user(){
    	return $this->hasMany('App\User', 'idTypeUser', 'id');
    }
}
