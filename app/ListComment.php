<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListComment extends Model
{
    protected $table = "listcomments";

    public function comment(){
    	return $this->belongsTo('App\Comment', 'idComment', 'id');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
