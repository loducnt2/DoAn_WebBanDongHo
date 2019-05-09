<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "devvn_quanhuyen";

    public function province(){
    	return $this->belongsTo('App\Province', 'idTP', 'maqh');
    }
    public function commune(){
    	return $this->hasMany('App\Commune', 'idQH', 'xaid');
    }

}

