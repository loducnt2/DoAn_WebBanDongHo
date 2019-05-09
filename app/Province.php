<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "devvn_tinhthanhpho";

    public function district(){
    	return $this->hasMany('App\District', 'idCategory', 'idTP');
    }
    public function commune(){
    	return $this->hasManyThrough('App\Commune', 'App\District', 'idTP', 'idQH', 'id');
    }
}
