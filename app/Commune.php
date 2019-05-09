<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = "devvn_xaphuongthitran";

    public function district(){
    	return $this->belongsTo('App\District', 'idQH', 'xaid');
    }
   
}
